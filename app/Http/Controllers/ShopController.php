<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pemilik_usaha.index');
    }
    public function register()
    {
        return view('pemilik_usaha.shop.registration');
    }
    public function register_store(Request $request)
    {
        // return Auth::user()->id;
        // return $request->all();
        $shop = new Shop();
        $shop->name = $request->get('shop_name');
        $shop->description = $request->get('description');
        $shop->address = $request->get('address');
        $shop->phone = $request->get('phone');
        $shop->latitude = $request->get('latitude');
        $shop->longitude = $request->get('longitude');
        $shop->open_hours = $request->get('open_hours');
        $shop->close_hours = $request->get('close_hours');
        $shop->users_id = Auth::user()->id;
        $shop->save();
        return redirect('shop');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $jumlah_terjual = DB::table('order_has_product')
        ->join('order','order.idorder','=','order_has_product.order_idorder')
        ->where('order.shop_idshop',$id)
        ->sum('order_has_product.qty');
        // return $jumlah_terjual;
        $data = DB::table('shop')->where('idshop','=',$id)->first();
        $product = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->where('product.shop_idshop','=',$id)
            ->select('product.*', 'product_image.name as picture')
            ->paginate(3);
        return view('user_umum.detailtoko.detailtoko', compact('data','product','jumlah_terjual'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = DB::table('shop')->where('users_id', Auth::user()->id)->first();
        return view('pemilik_usaha.shop.settings', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::table('shop')->where('users_id', Auth::user()->id)->update([
                'name' => $request->get('shop_name'),
                'description' => $request->get('description'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'latitude' => $request->get('latitude'),
                'longitude' => $request->get('longitude'),
                'open_hours' => $request->get('open_hours'),
                'close_hours' => $request->get('close_hours')
            ]);
            return redirect()->back()->with('message', 'Succes edit shop data');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
