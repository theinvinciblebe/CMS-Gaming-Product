<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SaleController extends Controller
{
    /**
     * Display a listing of sales orders with KPI metrics and filtering.
     */
    public function index(Request $request)
    {
        $query = SaleOrder::query();

        // Search filter
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                  ->orWhere('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('customer_email', 'LIKE', "%{$search}%")
                  ->orWhere('customer_phone', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('order_status', $request->input('status'));
        }

        // Payment status filter
        if ($request->filled('payment') && $request->input('payment') !== 'all') {
            $query->where('payment_status', $request->input('payment'));
        }

        // Date range filter
        if ($request->filled('date_range')) {
            switch ($request->input('date_range')) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'highest':
                $query->orderBy('total_amount', 'desc');
                break;
            case 'lowest':
                $query->orderBy('total_amount', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Calculate KPI Stats (across all data or current filter context)
        $totalOrdersCount = SaleOrder::count();
        $totalRevenue = SaleOrder::where('order_status', '!=', 'Cancelled')->sum('total_amount');
        $deliveredCount = SaleOrder::where('order_status', 'Delivered')->count();
        $activeProcessingCount = SaleOrder::whereIn('order_status', ['Processing', 'Pending', 'Shipped'])->count();
        $averageOrderValue = $totalOrdersCount > 0 ? ($totalRevenue / max(1, SaleOrder::where('order_status', '!=', 'Cancelled')->count())) : 0;
        $cancelledCount = SaleOrder::where('order_status', 'Cancelled')->count();

        $stats = [
            'total_revenue' => $totalRevenue,
            'total_orders' => $totalOrdersCount,
            'delivered_orders' => $deliveredCount,
            'active_orders' => $activeProcessingCount,
            'aov' => $averageOrderValue,
            'cancelled_orders' => $cancelledCount,
        ];

        $orders = $query->paginate(10)->withQueryString();

        return view('sales.index', [
            'orders' => $orders,
            'stats' => $stats,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Update order and payment status.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = SaleOrder::findOrFail($id);

        $request->validate([
            'order_status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
            'payment_status' => 'nullable|in:Paid,Pending,Refunded',
            'notes' => 'nullable|string|max:500',
        ]);

        $order->order_status = $request->input('order_status');
        if ($request->filled('payment_status')) {
            $order->payment_status = $request->input('payment_status');
        }
        if ($request->filled('notes')) {
            $order->notes = $request->input('notes');
        }
        $order->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Order #{$order->order_id} updated successfully!",
                'order' => $order
            ]);
        }

        return redirect()->back()->with('success', "Order #{$order->order_id} status updated to {$order->order_status}!");
    }

    /**
     * Delete an order record.
     */
    public function destroy($id)
    {
        $order = SaleOrder::findOrFail($id);
        $orderId = $order->order_id;
        $order->delete();

        return redirect()->back()->with('success', "Order #{$orderId} deleted successfully.");
    }

    /**
     * Show single order JSON for quick modal view.
     */
    public function show($id)
    {
        $order = SaleOrder::findOrFail($id);
        return response()->json($order);
    }

    /**
     * Export Sales History to CSV.
     */
    public function exportCsv(Request $request)
    {
        $orders = SaleOrder::orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="gaming_sales_history_' . date('Y-m-d') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Order ID',
                'Date',
                'Customer Name',
                'Customer Email',
                'Customer Phone',
                'Shipping Address',
                'City',
                'Payment Method',
                'Payment Status',
                'Order Status',
                'Subtotal ($)',
                'Discount ($)',
                'Shipping ($)',
                'Total Amount ($)',
                'Items Summary'
            ]);

            foreach ($orders as $order) {
                $itemsSummary = '';
                if (is_array($order->items_json)) {
                    foreach ($order->items_json as $item) {
                        $name = $item['name'] ?? 'Product';
                        $qty = $item['qty'] ?? 1;
                        $itemsSummary .= "{$name} (x{$qty}); ";
                    }
                }

                fputcsv($file, [
                    $order->order_id,
                    $order->created_at ? $order->created_at->format('Y-m-d H:i') : '',
                    $order->customer_name,
                    $order->customer_email,
                    $order->customer_phone ?? 'N/A',
                    $order->shipping_address ?? 'N/A',
                    $order->city ?? 'N/A',
                    $order->payment_method,
                    $order->payment_status,
                    $order->order_status,
                    number_format((float)$order->subtotal, 2),
                    number_format((float)$order->discount, 2),
                    number_format((float)$order->shipping_fee, 2),
                    number_format((float)$order->total_amount, 2),
                    rtrim($itemsSummary, '; ')
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
