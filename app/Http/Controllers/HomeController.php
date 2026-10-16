<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function normalizeTbl($tbl)
    {
        return array_map(function ($row) {
            $map = [
                'whitetitle' => 'whiteTitle',
                'bluetitle' => 'blueTitle',
                'sliderimage' => 'sliderImage',
                'btntitle' => 'btnTitle',
                'whitetitle2' => 'whiteTitle2',
                'bluetitle2' => 'blueTitle2',
                'sliderimage2' => 'sliderImage2',
                'btntitle2' => 'btnTitle2',
                'whitetitle3' => 'whiteTitle3',
                'bluetitle3' => 'blueTitle3',
                'sliderimage3' => 'sliderImage3',
                'btntitle3' => 'btnTitle3',
            ];
            foreach ($map as $lower => $camel) {
                if (isset($row->{$lower}) && !isset($row->{$camel})) {
                    $row->{$camel} = $row->{$lower};
                }
            }
            return $row;
        }, $tbl);
    }

    public function index()
    {
        $tbl = $this->normalizeTbl(DB::select('select * from tblmenubar;'));
        return view("menubar.index",['tbl'=>$tbl,'i'=>1]);
    }

    public function someMethod() {
        $tbl = $this->normalizeTbl(DB::select('select * from tblmenubar;'));
        return view("gaming-layout.home",['tbl'=>$tbl,'i'=>1]);
    }

    public function processCheckout(Request $request) {
        $orderId = 'GM-' . strtoupper(\Illuminate\Support\Str::random(6));

        $items = $request->input('items', []);
        $subtotal = (float) $request->input('subtotal', 0);
        $discount = (float) $request->input('discount', 0);
        $shipping = (float) $request->input('shipping_fee', 0);
        $total = (float) $request->input('total', 0);

        // Calculate fallback totals if not provided explicitly
        if ($total <= 0 && !empty($items)) {
            $subtotal = 0;
            foreach ($items as $item) {
                $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
            }
            $shipping = $subtotal >= 99 ? 0.00 : 9.99;
            $total = max(0, $subtotal - $discount + $shipping);
        }

        $saleOrder = \App\Models\SaleOrder::create([
            'order_id' => $orderId,
            'customer_name' => $request->input('name', 'Gamer Customer'),
            'customer_email' => $request->input('email', 'customer@example.com'),
            'customer_phone' => $request->input('phone', null),
            'shipping_address' => $request->input('address', 'Online Order'),
            'city' => $request->input('city', null),
            'postal_code' => $request->input('postal_code', null),
            'payment_method' => $request->input('payment_method', 'Credit Card'),
            'payment_status' => 'Paid',
            'order_status' => 'Processing',
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping_fee' => $shipping,
            'total_amount' => $total,
            'promo_code' => $request->input('promo_code', null),
            'items_json' => $items,
            'notes' => $request->input('notes', 'Web checkout order placed via storefront.')
        ]);

        session()->push('orders', $saleOrder->toArray());

        return response()->json([
            'status' => 'success',
            'order_id' => $orderId,
            'order' => $saleOrder,
            'message' => 'Order placed and recorded successfully!'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeModel $homeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeModel $homeModel,$id)
    {
        $tbl = DB::select('select * from tblmenubar where navid='.$id.';');
        return view("menubar.edit",['tbl'=>$tbl]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeModel $homeModel,$id)
    {
        if($request->hasFile('file')){
            $request->validate([
                'file' => 'required|mimes:pdf,xlx,csv,gif,png,jpg,jpeg|max:20480',
            ]);
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('image'), $fileName);
        }
        else{
            $fileName = request("noPhoto");
        }

        $txtName = request("txtName");
        $txtNav1 = request("txtNav1");
        $txtNav2 = request("txtNav2");
        $txtNav3 = request("txtNav3");
        $txtNav4 = request("txtNav4");
        $txtNav5 = request("txtNav5");
        $txtNav6 = request("txtNav6");
        $txtNav7 = request("txtNav7");
        $txtNav8 = request("txtNav8");
        DB::UPDATE("UPDATE tblmenubar SET name= '".$txtName."', nav1='".$txtNav1."', nav2='".$txtNav2."', nav3='".$txtNav3."', nav4='".$txtNav4."', nav5='".$txtNav5."', nav6='".$txtNav6."', nav7='".$txtNav7."', nav8='".$txtNav8."'
                    ,logo='".$fileName."' WHERE navid=".$id.";");
        return redirect('/dashboard');
    }

    public function editSlider(HomeModel $homeModel,$id)
    {
        $tbl = DB::select('select * from tblmenubar where navid='.$id.';');
        return view("menubar.editSlider",['tbl'=>$tbl]);
    }

    public function updateSlider(Request $request, HomeModel $homeModel,$id)
    {
        if($request->hasFile('file')){
            $request->validate([
                'file' => 'required|mimes:pdf,xlx,csv,gif,png,jpg,jpeg|max:20480',
            ]);
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('image'), $fileName);
        }
        else{
            $fileName = request("noPhoto");
        }

        $txtWhite = request("txtWhite");
        $txtBlue = request("txtBlue");
        $txtDesc = request("txtDesc");
        $txtBtn= request("txtBtn");
        DB::UPDATE("UPDATE tblmenubar SET whiteTitle= '".$txtWhite."', blueTitle='".$txtBlue."', description='".$txtDesc."', btnTitle='".$txtBtn."'
                    ,sliderImage='".$fileName."' WHERE navid=".$id.";");
        return redirect('/dashboard');
    }


    public function editSlider2(HomeModel $homeModel,$id)
    {
        $tbl = DB::select('select * from tblmenubar where navid='.$id.';');
        return view("menubar.editSlider2",['tbl'=>$tbl]);
    }

    public function updateSlider2(Request $request, HomeModel $homeModel,$id)
    {
        if($request->hasFile('file')){
            $request->validate([
                'file' => 'required|mimes:pdf,xlx,csv,gif,png,jpg,jpeg|max:20480',
            ]);
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('image'), $fileName);
        }
        else{
            $fileName = request("noPhoto");
        }

        $txtWhite = request("txtWhite2");
        $txtBlue = request("txtBlue2");
        $txtDesc = request("txtDesc2");
        $txtBtn= request("txtBtn2");
        DB::UPDATE("UPDATE tblmenubar SET whiteTitle2= '".$txtWhite."', blueTitle2='".$txtBlue."', description2='".$txtDesc."', btnTitle2='".$txtBtn."'
                    ,sliderImage2='".$fileName."' WHERE navid=".$id.";");
        return redirect('/dashboard');
    }

    public function editSlider3(HomeModel $homeModel,$id)
    {
        $tbl = DB::select('select * from tblmenubar where navid='.$id.';');
        return view("menubar.editSlider3",['tbl'=>$tbl]);
    }

    public function updateSlider3(Request $request, HomeModel $homeModel,$id)
    {
        if($request->hasFile('file')){
            $request->validate([
                'file' => 'required|mimes:pdf,xlx,csv,gif,png,jpg,jpeg|max:20480',
            ]);
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('image'), $fileName);
        }
        else{
            $fileName = request("noPhoto");
        }

        $txtWhite = request("txtWhite3");
        $txtBlue = request("txtBlue3");
        $txtDesc = request("txtDesc3");
        $txtBtn= request("txtBtn3");
        DB::UPDATE("UPDATE tblmenubar SET whiteTitle3= '".$txtWhite."', blueTitle3='".$txtBlue."', description3='".$txtDesc."', btnTitle3='".$txtBtn."'
                    ,sliderImage3='".$fileName."' WHERE navid=".$id.";");
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeModel $homeModel)
    {
        //
    }
}
