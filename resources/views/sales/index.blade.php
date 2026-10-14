@extends('dashboard-layout.main')

@section('content')
<style>
    /* ==========================================================================
       Sales History & Orders Management Styling (Light & Dark Mode)
       ========================================================================== */

    /* KPI Summary Cards */
    .sales-kpi-card {
        background: var(--cms-card-bg, #ffffff);
        border: 1px solid var(--cms-border, #e2e8f0);
        border-radius: 16px;
        padding: 1.35rem 1.25rem;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }
    html.dark .sales-kpi-card {
        background: var(--cms-card-bg, #131722);
        border-color: var(--cms-border, rgba(255, 255, 255, 0.08));
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
    }
    .sales-kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.12);
        border-color: var(--cms-border-glow, rgba(99, 102, 241, 0.3));
    }
    .sales-kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }
    .kpi-rev::before { background: linear-gradient(90deg, #10b981, #059669); }
    .kpi-orders::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
    .kpi-aov::before { background: linear-gradient(90deg, #06b6d4, #3b82f6); }
    .kpi-delivered::before { background: linear-gradient(90deg, #10b981, #34d399); }
    .kpi-active::before { background: linear-gradient(90deg, #f59e0b, #d97706); }

    .kpi-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .kpi-number {
        font-size: 1.85rem;
        font-weight: 800;
        color: var(--cms-text-primary, #0f172a);
        line-height: 1.1;
    }

    /* Filter Panel */
    .filter-panel {
        background: var(--cms-card-bg, #ffffff);
        border: 1px solid var(--cms-border, #e2e8f0);
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    }
    html.dark .filter-panel {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    }

    /* Table & Container */
    .sales-table-card {
        background: var(--cms-card-bg, #ffffff);
        border: 1px solid var(--cms-border, #e2e8f0);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }
    html.dark .sales-table-card {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
    }

    .sales-table thead th {
        background: #f8fafc;
        color: var(--cms-text-muted, #64748b);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        border-bottom: 1px solid var(--cms-border, #e2e8f0);
        padding: 1rem 1.15rem;
    }
    html.dark .sales-table thead th {
        background: rgba(0, 0, 0, 0.25);
        color: var(--cms-text-muted, #94a3b8);
        border-bottom-color: var(--cms-border, rgba(255, 255, 255, 0.08));
    }

    .sales-table tbody td {
        color: var(--cms-text-primary, #0f172a);
        border-bottom: 1px solid var(--cms-border, #e2e8f0);
        padding: 1.1rem 1.15rem;
        vertical-align: middle;
        font-size: 0.92rem;
    }
    html.dark .sales-table tbody td {
        color: var(--cms-text-primary, #f1f5f9);
        border-bottom-color: var(--cms-border, rgba(255, 255, 255, 0.06));
    }
    .sales-table tbody tr:hover td {
        background: rgba(99, 102, 241, 0.04);
    }
    html.dark .sales-table tbody tr:hover td {
        background: rgba(99, 102, 241, 0.08);
    }

    /* Order ID Badge */
    .order-id-badge {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 800;
        font-size: 0.92rem;
        color: #0284c7;
        background: rgba(14, 165, 233, 0.1);
        padding: 0.3rem 0.65rem;
        border-radius: 6px;
        border: 1px solid rgba(14, 165, 233, 0.25);
        transition: all 0.2s ease;
    }
    .order-id-badge:hover {
        background: #0284c7;
        color: #ffffff;
    }
    html.dark .order-id-badge {
        color: #38bdf8;
        background: rgba(56, 189, 248, 0.12);
        border-color: rgba(56, 189, 248, 0.3);
    }
    html.dark .order-id-badge:hover {
        background: #38bdf8;
        color: #0b0f19;
    }

    /* Order Status Badges - Light & Dark Mode */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    .status-delivered {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    html.dark .status-delivered {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
        border-color: rgba(16, 185, 129, 0.3);
    }

    .status-shipped {
        background: #f0f9ff;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }
    html.dark .status-shipped {
        background: rgba(14, 165, 233, 0.15);
        color: #38bdf8;
        border-color: rgba(14, 165, 233, 0.3);
    }

    .status-processing {
        background: #f5f3ff;
        color: #7c3aed;
        border: 1px solid #ddd6fe;
    }
    html.dark .status-processing {
        background: rgba(139, 92, 246, 0.15);
        color: #a78bfa;
        border-color: rgba(139, 92, 246, 0.3);
    }

    .status-pending {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    html.dark .status-pending {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border-color: rgba(245, 158, 11, 0.3);
    }

    .status-cancelled {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    html.dark .status-cancelled {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.3);
    }

    /* Action Buttons */
    .btn-action-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--cms-border, #e2e8f0);
        background: #f8fafc;
        color: var(--cms-text-secondary, #334155);
        transition: all 0.2s ease;
        cursor: pointer;
    }
    html.dark .btn-action-icon {
        background: rgba(255, 255, 255, 0.04);
        border-color: var(--cms-border, rgba(255, 255, 255, 0.1));
        color: var(--cms-text-primary, #f1f5f9);
    }
    .btn-action-icon:hover {
        background: #6366f1 !important;
        color: #ffffff !important;
        border-color: #6366f1 !important;
        transform: scale(1.08);
    }
    .btn-action-delete:hover {
        background: #ef4444 !important;
        border-color: #ef4444 !important;
    }

    /* Form Controls in Sales - Light & Dark */
    .sales-input, .sales-select {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #0f172a !important;
        border-radius: 10px !important;
        padding: 0.55rem 0.9rem !important;
        font-size: 0.9rem !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    html.dark .sales-input, html.dark .sales-select {
        background: rgba(0, 0, 0, 0.25) !important;
        border: 1px solid var(--cms-border, rgba(255, 255, 255, 0.12)) !important;
        color: var(--cms-text-primary, #f1f5f9) !important;
    }
    .sales-input:focus, .sales-select:focus {
        border-color: #6366f1 !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.22) !important;
    }
    .sales-select option {
        background: #ffffff;
        color: #0f172a;
    }
    html.dark .sales-select option {
        background: #0f172a;
        color: #f8fafc;
    }

    /* Items Pill in Table */
    .items-count-pill {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        font-size: 0.82rem;
        padding: 0.35rem 0.7rem;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    html.dark .items-count-pill {
        background: rgba(255, 255, 255, 0.06);
        color: #e2e8f0;
        border-color: rgba(255, 255, 255, 0.08);
    }

    /* Gaming Modal Styling for Both Light and Dark */
    .modal-content.gaming-modal-content {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        color: #0f172a;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }
    html.dark .modal-content.gaming-modal-content {
        background: #131722;
        border-color: rgba(255, 255, 255, 0.12);
        color: #f8fafc;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
    }
    .modal-header.gaming-modal-header {
        border-bottom: 1px solid #e2e8f0;
        padding: 1.25rem 1.5rem;
    }
    html.dark .modal-header.gaming-modal-header {
        border-bottom-color: rgba(255, 255, 255, 0.08);
    }
    .modal-footer.gaming-modal-footer {
        border-top: 1px solid #e2e8f0;
        padding: 1rem 1.5rem;
    }
    html.dark .modal-footer.gaming-modal-footer {
        border-top-color: rgba(255, 255, 255, 0.08);
    }

    .modal-info-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        height: 100%;
        color: #0f172a;
    }
    html.dark .modal-info-box {
        background: rgba(255, 255, 255, 0.03);
        border-color: rgba(255, 255, 255, 0.08);
        color: #f8fafc;
    }

    .modal-totals-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        color: #0f172a;
    }
    html.dark .modal-totals-box {
        background: rgba(0, 0, 0, 0.25);
        border-color: rgba(255, 255, 255, 0.08);
        color: #f8fafc;
    }

    .modal-close-btn {
        color: #64748b;
        opacity: 0.8;
        font-size: 1.5rem;
        outline: none;
        background: none;
        border: none;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .modal-close-btn:hover {
        color: #0f172a;
        opacity: 1;
    }
    html.dark .modal-close-btn {
        color: #94a3b8;
    }
    html.dark .modal-close-btn:hover {
        color: #ffffff;
    }

    .modal-items-table thead {
        background: #f1f5f9;
        font-size: 0.78rem;
        text-transform: uppercase;
        color: #64748b;
    }
    html.dark .modal-items-table thead {
        background: rgba(0, 0, 0, 0.35);
        color: #94a3b8;
    }
    .modal-items-table td {
        border-color: #e2e8f0;
        color: #0f172a;
    }
    html.dark .modal-items-table td {
        border-color: rgba(255, 255, 255, 0.06);
        color: #f1f5f9;
    }

    /* Print styling */
    @media print {
        body * {
            visibility: hidden;
        }
        #printableInvoiceArea, #printableInvoiceArea * {
            visibility: visible;
        }
        #printableInvoiceArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: white !important;
            color: black !important;
            padding: 20px;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="content-header pt-4 pb-3">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <div>
                <h1 class="m-0 font-weight-bold" style="font-size: 1.75rem; letter-spacing: -0.5px; color: var(--cms-text-primary, #0f172a);">
                    <i class="fas fa-shopping-bag mr-2 text-primary"></i> Sales & Order History
                </h1>
                <p class="mb-0 text-muted" style="font-size: 0.95rem;">
                    Storefront gaming transactions, revenue performance, and customer order fulfillment
                </p>
            </div>
            <div class="d-flex align-items-center gap-2 mt-3 mt-md-0" style="gap: 10px;">
                <a href="{{ route('sales.export') }}" class="btn btn-outline-success font-weight-bold" style="border-radius: 10px; padding: 0.55rem 1.1rem; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fas fa-file-csv"></i> Export CSV Report
                </a>
                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.location.reload()" style="background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 10px; padding: 0.55rem 1.1rem; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(99,102,241,0.35);">
                    <i class="fas fa-sync-alt"></i> Refresh Data
                </button>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- ====================================================================
             1. KPI STATS OVERVIEW CARDS
             ==================================================================== -->
        <div class="row mb-4">
            <!-- Total Revenue -->
            <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                <div class="sales-kpi-card kpi-rev">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #10b981;">Total Gross Revenue</span>
                        <div class="kpi-icon-wrap" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="kpi-number">
                        ${{ number_format($stats['total_revenue'], 2) }}
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 0.8rem; display: flex; align-items: center; gap: 6px;">
                        <span style="color: #10b981; font-weight: 600;"><i class="fas fa-arrow-up"></i> Live Ledger</span>
                        <span>excludes cancelled</span>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                <div class="sales-kpi-card kpi-orders">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #6366f1;">Total Orders</span>
                        <div class="kpi-icon-wrap" style="background: rgba(99, 102, 241, 0.15); color: #6366f1;">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                    <div class="kpi-number">
                        {{ $stats['total_orders'] }}
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 0.8rem;">
                        All-time storefront checkouts
                    </div>
                </div>
            </div>

            <!-- Average Order Value (AOV) -->
            <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                <div class="sales-kpi-card kpi-aov">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #0284c7;">Average Order (AOV)</span>
                        <div class="kpi-icon-wrap" style="background: rgba(6, 182, 212, 0.15); color: #0284c7;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="kpi-number">
                        ${{ number_format($stats['aov'], 2) }}
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 0.8rem;">
                        Per completed checkout basket
                    </div>
                </div>
            </div>

            <!-- Active / Fulfilled -->
            <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                <div class="sales-kpi-card kpi-delivered">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #059669;">Fulfillment Rate</span>
                        <div class="kpi-icon-wrap" style="background: rgba(16, 185, 129, 0.15); color: #059669;">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                    </div>
                    <div class="kpi-number">
                        {{ $stats['delivered_orders'] }} <span style="font-size: 1rem; font-weight: 500; color: var(--cms-text-muted, #64748b);">Delivered</span>
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 0.8rem;">
                        <span style="color: #d97706; font-weight: 600;">{{ $stats['active_orders'] }} active</span> awaiting dispatch
                    </div>
                </div>
            </div>
        </div>

        <!-- ====================================================================
             2. FILTERS & SEARCH CONTROL PANEL
             ==================================================================== -->
        <div class="filter-panel">
            <form method="GET" action="{{ route('sales.index') }}">
                <div class="row align-items-end">
                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                        <label class="text-muted font-weight-bold mb-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">Search Orders</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text sales-input" style="border-right: none; border-radius: 10px 0 0 10px !important;"><i class="fas fa-search text-muted"></i></span>
                            </div>
                            <input type="text" name="search" class="form-control sales-input" style="border-left: none; border-radius: 0 10px 10px 0 !important;" placeholder="Order ID, Customer, Email..." value="{{ $filters['search'] ?? '' }}">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 mb-3 mb-lg-0">
                        <label class="text-muted font-weight-bold mb-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">Order Status</label>
                        <select name="status" class="form-control sales-select">
                            <option value="all" {{ ($filters['status'] ?? '') == 'all' ? 'selected' : '' }}>All Statuses</option>
                            <option value="Processing" {{ ($filters['status'] ?? '') == 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Shipped" {{ ($filters['status'] ?? '') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="Delivered" {{ ($filters['status'] ?? '') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="Pending" {{ ($filters['status'] ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Cancelled" {{ ($filters['status'] ?? '') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-3 mb-3 mb-lg-0">
                        <label class="text-muted font-weight-bold mb-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">Payment</label>
                        <select name="payment" class="form-control sales-select">
                            <option value="all" {{ ($filters['payment'] ?? '') == 'all' ? 'selected' : '' }}>All Payments</option>
                            <option value="Paid" {{ ($filters['payment'] ?? '') == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Pending" {{ ($filters['payment'] ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Refunded" {{ ($filters['payment'] ?? '') == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4 mb-3 mb-lg-0">
                        <label class="text-muted font-weight-bold mb-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">Timeframe</label>
                        <select name="date_range" class="form-control sales-select">
                            <option value="" {{ empty($filters['date_range']) ? 'selected' : '' }}>All Time</option>
                            <option value="today" {{ ($filters['date_range'] ?? '') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="week" {{ ($filters['date_range'] ?? '') == 'week' ? 'selected' : '' }}>This Week</option>
                            <option value="month" {{ ($filters['date_range'] ?? '') == 'month' ? 'selected' : '' }}>This Month</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4 mb-3 mb-lg-0">
                        <label class="text-muted font-weight-bold mb-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">Sort By</label>
                        <select name="sort" class="form-control sales-select">
                            <option value="latest" {{ ($filters['sort'] ?? '') == 'latest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ ($filters['sort'] ?? '') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="highest" {{ ($filters['sort'] ?? '') == 'highest' ? 'selected' : '' }}>Highest Total</option>
                            <option value="lowest" {{ ($filters['sort'] ?? '') == 'lowest' ? 'selected' : '' }}>Lowest Total</option>
                        </select>
                    </div>

                    <div class="col-lg-1 col-md-4 d-flex" style="gap: 8px;">
                        <button type="submit" class="btn btn-primary w-100 font-weight-bold" style="border-radius: 10px; padding: 0.55rem; background: #6366f1; border-color: #6366f1;" title="Apply Filters">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary font-weight-bold" style="border-radius: 10px; padding: 0.55rem;" title="Reset Filters">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- ====================================================================
             3. SALES ORDERS LEDGER TABLE
             ==================================================================== -->
        <div class="sales-table-card mb-4">
            <div class="table-responsive">
                <table class="table sales-table mb-0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date & Time</th>
                            <th>Items</th>
                            <th>Payment</th>
                            <th>Total Amount</th>
                            <th>Fulfillment Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <!-- Order ID -->
                            <td>
                                <a href="javascript:void(0)" onclick="openOrderModal({{ $order->id }})" style="text-decoration: none;">
                                    <span class="order-id-badge">
                                        #{{ $order->order_id }}
                                    </span>
                                </a>
                            </td>

                            <!-- Customer -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div style="width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #3b82f6); display: flex; align-items: center; justify-content: center; font-weight: 800; color: #ffffff; font-size: 0.95rem; margin-right: 12px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(99,102,241,0.25);">
                                        {{ strtoupper(substr($order->customer_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: var(--cms-text-primary, #0f172a); line-height: 1.2;">
                                            {{ $order->customer_name }}
                                        </div>
                                        <div class="text-muted" style="font-size: 0.8rem;">
                                            {{ $order->customer_email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Date & Time -->
                            <td>
                                <div style="font-weight: 600; color: var(--cms-text-primary, #0f172a);">
                                    {{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}
                                </div>
                                <div class="text-muted" style="font-size: 0.78rem;">
                                    {{ $order->created_at ? $order->created_at->format('H:i A') . ' (' . $order->created_at->diffForHumans() . ')' : '' }}
                                </div>
                            </td>

                            <!-- Items -->
                            <td>
                                @php
                                    $itemCount = is_array($order->items_json) ? count($order->items_json) : 0;
                                    $totalUnits = is_array($order->items_json) ? array_sum(array_column($order->items_json, 'qty')) : 0;
                                @endphp
                                <span class="items-count-pill">
                                    <i class="fas fa-boxes text-primary mr-1"></i> {{ $itemCount }} items ({{ $totalUnits }} units)
                                </span>
                            </td>

                            <!-- Payment Method & Status -->
                            <td>
                                <div class="d-flex align-items-center" style="gap: 8px;">
                                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--cms-text-primary, #0f172a);">
                                        @if(stripos($order->payment_method, 'CARD') !== false)
                                            <i class="fab fa-cc-visa text-primary mr-1"></i> Card
                                        @elseif(stripos($order->payment_method, 'PAYPAL') !== false)
                                            <i class="fab fa-paypal text-info mr-1"></i> PayPal
                                        @else
                                            <i class="fas fa-hand-holding-usd text-warning mr-1"></i> COD
                                        @endif
                                    </span>
                                    @if($order->payment_status == 'Paid')
                                        <span class="badge badge-success" style="font-size: 0.7rem; padding: 3px 6px;">PAID</span>
                                    @elseif($order->payment_status == 'Refunded')
                                        <span class="badge badge-danger" style="font-size: 0.7rem; padding: 3px 6px;">REFUNDED</span>
                                    @else
                                        <span class="badge badge-warning" style="font-size: 0.7rem; padding: 3px 6px;">PENDING</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Total Amount -->
                            <td>
                                <div style="font-size: 1.05rem; font-weight: 800; color: #059669;">
                                    ${{ number_format($order->total_amount, 2) }}
                                </div>
                                @if($order->discount > 0)
                                    <div style="font-size: 0.75rem; color: #d97706; font-weight: 600;">
                                        Saved ${{ number_format($order->discount, 2) }}
                                    </div>
                                @endif
                            </td>

                            <!-- Order Status -->
                            <td>
                                @php
                                    $st = strtolower($order->order_status);
                                    $badgeClass = 'status-' . $st;
                                @endphp
                                <span class="status-badge {{ $badgeClass }}">
                                    @if($st == 'delivered')
                                        <i class="fas fa-check-circle"></i> Delivered
                                    @elseif($st == 'shipped')
                                        <i class="fas fa-shipping-fast"></i> Shipped
                                    @elseif($st == 'processing')
                                        <i class="fas fa-cog fa-spin"></i> Processing
                                    @elseif($st == 'cancelled')
                                        <i class="fas fa-times-circle"></i> Cancelled
                                    @else
                                        <i class="fas fa-clock"></i> Pending
                                    @endif
                                </span>
                            </td>

                            <!-- Action Buttons -->
                            <td class="text-right">
                                <div class="d-inline-flex" style="gap: 6px;">
                                    <!-- View Details Modal Trigger -->
                                    <button type="button" class="btn-action-icon" title="View Order Details" onclick="openOrderModal({{ $order->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Quick Change Status Trigger -->
                                    <button type="button" class="btn-action-icon" title="Update Fulfillment Status" onclick="openStatusModal({{ $order->id }}, '{{ $order->order_status }}', '{{ $order->payment_status }}', '{{ $order->order_id }}')">
                                        <i class="fas fa-truck"></i>
                                    </button>

                                    <!-- Delete Order -->
                                    <form method="POST" action="{{ route('sales.delete', $order->id) }}" class="d-inline" onsubmit="return confirm('Delete order #{{ $order->order_id }} permanently?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-icon btn-action-delete" title="Delete Order">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="my-4">
                                    <i class="fas fa-receipt fa-4x text-muted mb-3" style="opacity: 0.4;"></i>
                                    <h4 class="font-weight-bold" style="color: var(--cms-text-primary, #0f172a);">No Sales Orders Found</h4>
                                    <p class="text-muted mb-3">No orders matched your current search and filter criteria.</p>
                                    <a href="{{ route('sales.index') }}" class="btn btn-outline-primary" style="border-radius: 10px;">
                                        Reset All Filters
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            @if($orders->hasPages())
            <div class="d-flex justify-content-between align-items-center p-3" style="border-top: 1px solid var(--cms-border, #e2e8f0);">
                <div class="text-muted" style="font-size: 0.88rem;">
                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} sales records
                </div>
                <div>
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>

    </div>
</section>

<!-- ==========================================================================
     ORDER DETAILS & INVOICE MODAL
     ========================================================================== -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content gaming-modal-content">
            <div class="modal-header gaming-modal-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title font-weight-bold mb-0" id="orderDetailsModalLabel" style="color: var(--cms-text-primary, #0f172a);">
                        <i class="fas fa-file-invoice text-primary mr-2"></i> Order Breakdown & Receipt
                    </h5>
                    <div id="modalOrderSubtitle" class="text-muted" style="font-size: 0.85rem;"></div>
                </div>
                <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="printableInvoiceArea">
                <!-- Customer & Delivery Info Grid -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="modal-info-box">
                            <h6 class="font-weight-bold mb-2" style="color: #0284c7; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.8px;">
                                <i class="fas fa-user-circle mr-1"></i> Customer Information
                            </h6>
                            <div id="modalCustName" style="font-weight: 700; font-size: 1.05rem; color: var(--cms-text-primary, #0f172a);"></div>
                            <div id="modalCustEmail" class="text-muted" style="font-size: 0.88rem;"></div>
                            <div id="modalCustPhone" class="text-muted" style="font-size: 0.88rem;"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-info-box">
                            <h6 class="font-weight-bold mb-2" style="color: #059669; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.8px;">
                                <i class="fas fa-shipping-fast mr-1"></i> Shipping & Delivery Destination
                            </h6>
                            <div id="modalCustAddress" style="font-weight: 600; font-size: 0.95rem; color: var(--cms-text-primary, #0f172a);"></div>
                            <div id="modalCustCity" class="text-muted" style="font-size: 0.88rem;"></div>
                            <div id="modalPaymentInfo" class="mt-2 text-muted" style="font-size: 0.85rem;"></div>
                        </div>
                    </div>
                </div>

                <!-- Purchased Line Items -->
                <h6 class="font-weight-bold mb-2" style="color: var(--cms-text-primary, #0f172a); font-size: 0.88rem; text-transform: uppercase; letter-spacing: 0.8px;">
                    <i class="fas fa-cube mr-1 text-primary"></i> Purchased Gaming Hardware
                </h6>
                <div class="table-responsive mb-4" style="border: 1px solid var(--cms-border, #e2e8f0); border-radius: 12px; overflow: hidden;">
                    <table class="table modal-items-table mb-0">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Line Total</th>
                            </tr>
                        </thead>
                        <tbody id="modalItemsTbody">
                            <!-- Populated dynamically via JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Financial Totals Summary -->
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <div class="modal-totals-box">
                            <div class="d-flex justify-content-between mb-1" style="font-size: 0.9rem;">
                                <span class="text-muted">Subtotal:</span>
                                <span id="modalSubtotal" class="font-weight-bold" style="color: var(--cms-text-primary, #0f172a);">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1" style="font-size: 0.9rem;">
                                <span class="text-muted">Discount Savings:</span>
                                <span id="modalDiscount" class="font-weight-bold" style="color: #d97706;">-$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size: 0.9rem;">
                                <span class="text-muted">Shipping & Handling:</span>
                                <span id="modalShipping" class="font-weight-bold" style="color: var(--cms-text-primary, #0f172a);">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between pt-2" style="border-top: 1px solid var(--cms-border, #e2e8f0); font-size: 1.2rem; font-weight: 800;">
                                <span style="color: var(--cms-text-primary, #0f172a);">Grand Total:</span>
                                <span id="modalGrandTotal" style="color: #059669;">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modalOrderNotesWrap" class="mt-3 p-3 text-muted" style="background: rgba(99,102,241,0.05); border: 1px solid var(--cms-border, #e2e8f0); border-radius: 8px; font-size: 0.85rem; display: none;">
                    <strong style="color: var(--cms-text-primary, #0f172a);"><i class="fas fa-sticky-note mr-1 text-primary"></i> Order Notes:</strong> <span id="modalOrderNotes"></span>
                </div>
            </div>
            <div class="modal-footer gaming-modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">
                    Close
                </button>
                <div class="d-flex" style="gap: 8px;">
                    <button type="button" class="btn btn-outline-info font-weight-bold" onclick="window.print()" style="border-radius: 10px; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-print"></i> Print Invoice
                    </button>
                    <button type="button" class="btn btn-primary font-weight-bold" id="btnModalQuickStatus" style="border-radius: 10px; background: #6366f1; border-color: #6366f1;">
                        <i class="fas fa-truck mr-1"></i> Update Status
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
     UPDATE ORDER FULFILLMENT STATUS MODAL
     ========================================================================== -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1" role="dialog" aria-labelledby="statusUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content gaming-modal-content">
            <form id="statusUpdateForm" method="POST" action="">
                @csrf
                <div class="modal-header gaming-modal-header">
                    <h5 class="modal-title font-weight-bold mb-0" id="statusUpdateModalLabel" style="color: var(--cms-text-primary, #0f172a);">
                        <i class="fas fa-truck-loading text-primary mr-2"></i> Update Order Status
                    </h5>
                    <button type="button" class="modal-close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3 text-center">
                        <span class="order-id-badge" id="statusModalOrderBadge" style="font-size: 1.05rem; padding: 0.5rem 1.25rem;">
                            #GM-XXXXXX
                        </span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-muted mb-1" style="font-size: 0.85rem;">Fulfillment Order Status</label>
                        <select name="order_status" id="selectOrderStatus" class="form-control sales-select" required>
                            <option value="Processing">Processing (Preparing Gear)</option>
                            <option value="Shipped">Shipped (In Transit with Courier)</option>
                            <option value="Delivered">Delivered (Handed to Customer)</option>
                            <option value="Pending">Pending (Awaiting Payment / Verification)</option>
                            <option value="Cancelled">Cancelled (Order Voided)</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-muted mb-1" style="font-size: 0.85rem;">Payment Status</label>
                        <select name="payment_status" id="selectPaymentStatus" class="form-control sales-select" required>
                            <option value="Paid">Paid (Confirmed)</option>
                            <option value="Pending">Pending (Unpaid)</option>
                            <option value="Refunded">Refunded (Amount Returned)</option>
                        </select>
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-muted mb-1" style="font-size: 0.85rem;">Internal Admin Notes (Optional)</label>
                        <textarea name="notes" id="textareaNotes" class="form-control sales-input" rows="3" placeholder="Tracking courier number, customer communication, etc."></textarea>
                    </div>
                </div>
                <div class="modal-footer gaming-modal-footer">
                    <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary font-weight-bold" style="background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 10px; padding: 0.55rem 1.25rem;">
                        <i class="fas fa-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Global orders cache for fast modal rendering
    const salesData = @json($orders->items());

    // Open detailed order breakdown modal
    function openOrderModal(orderId) {
        const order = salesData.find(o => o.id == orderId);
        if (!order) return;

        document.getElementById('modalOrderSubtitle').textContent = `Order #${order.order_id} • Placed ${new Date(order.created_at).toLocaleString()}`;
        document.getElementById('modalCustName').textContent = order.customer_name;
        document.getElementById('modalCustEmail').textContent = order.customer_email || 'No email provided';
        document.getElementById('modalCustPhone').textContent = order.customer_phone ? `Phone: ${order.customer_phone}` : '';
        document.getElementById('modalCustAddress').textContent = order.shipping_address || 'Online / Pickup Order';
        document.getElementById('modalCustCity').textContent = order.city ? `${order.city}` : '';
        document.getElementById('modalPaymentInfo').innerHTML = `<strong>Payment:</strong> ${order.payment_method} (${order.payment_status})`;

        // Populate items table
        const tbody = document.getElementById('modalItemsTbody');
        tbody.innerHTML = '';

        if (Array.isArray(order.items_json) && order.items_json.length > 0) {
            order.items_json.forEach(item => {
                const price = parseFloat(item.price || 0);
                const qty = parseInt(item.qty || 1);
                const lineTotal = (price * qty).toFixed(2);
                tbody.innerHTML += `
                    <tr>
                        <td>
                            <div class="font-weight-bold" style="color: var(--cms-text-primary, #0f172a);">${item.name || 'Gaming Gear'}</div>
                            <small class="text-muted">Item ID: ${item.id || 'N/A'}</small>
                        </td>
                        <td class="text-center font-weight-bold">${qty}</td>
                        <td class="text-right">$${price.toFixed(2)}</td>
                        <td class="text-right font-weight-bold" style="color: #0284c7;">$${lineTotal}</td>
                    </tr>
                `;
            });
        } else {
            tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted py-3">No specific line item metadata recorded.</td></tr>`;
        }

        // Totals
        document.getElementById('modalSubtotal').textContent = `$${parseFloat(order.subtotal || 0).toFixed(2)}`;
        document.getElementById('modalDiscount').textContent = `-$${parseFloat(order.discount || 0).toFixed(2)}`;
        document.getElementById('modalShipping').textContent = `$${parseFloat(order.shipping_fee || 0).toFixed(2)}`;
        document.getElementById('modalGrandTotal').textContent = `$${parseFloat(order.total_amount || 0).toFixed(2)}`;

        // Notes
        const notesWrap = document.getElementById('modalOrderNotesWrap');
        if (order.notes) {
            notesWrap.style.display = 'block';
            document.getElementById('modalOrderNotes').textContent = order.notes;
        } else {
            notesWrap.style.display = 'none';
        }

        // Setup quick status button in details modal
        const btnQuick = document.getElementById('btnModalQuickStatus');
        btnQuick.onclick = function() {
            $('#orderDetailsModal').modal('hide');
            openStatusModal(order.id, order.order_status, order.payment_status, order.order_id);
        };

        $('#orderDetailsModal').modal('show');
    }

    // Open quick status update modal
    function openStatusModal(id, currentStatus, currentPayment, orderId) {
        const form = document.getElementById('statusUpdateForm');
        form.action = `/sales-management/update-status/${id}`;

        document.getElementById('statusModalOrderBadge').textContent = `#${orderId}`;
        document.getElementById('selectOrderStatus').value = currentStatus;
        document.getElementById('selectPaymentStatus').value = currentPayment;

        const order = salesData.find(o => o.id == id);
        document.getElementById('textareaNotes').value = order && order.notes ? order.notes : '';

        $('#statusUpdateModal').modal('show');
    }
</script>
@endsection
