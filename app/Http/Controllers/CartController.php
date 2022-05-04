<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('product')
        //     ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
        //     ->join('cart', 'cart.product_idproduct', '=', 'product.idproduct')
        //     ->where('cart.users_id', '=', Auth::user()->id)
        //     ->select('product.*', 'product_image.name as picture', 'cart.qty as qty')
        //     ->get();
        //return $data;
        return view('user_umum.cart.cart');
    }
    //Untuk Notifikasi bagian atas
    public function indexAjax()
    {
        $data = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->join('cart', 'cart.product_idproduct', '=', 'product.idproduct')
            ->where('cart.users_id', '=', Auth::user()->id)
            ->select('product.*', 'product_image.name as picture', 'cart.qty as qty')
            ->get();
        return $data;
    }
    //Untuk halaman cart keranjang
    public function indexAjaxHalaman(){
        $data = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->join('cart', 'cart.product_idproduct', '=', 'product.idproduct')
            ->where('cart.users_id', '=', Auth::user()->id)
            ->select('product.*', 'product_image.name as picture', 'cart.qty as qty')
            ->get();
        $data_penjual = DB::table('product')
            ->join('cart', 'cart.product_idproduct', '=', 'product.idproduct')
            ->join('shop','shop.idshop','=','product.shop_idshop')
            ->where('cart.users_id', '=', Auth::user()->id)
            ->select('shop.idshop','shop.name')
            ->groupBy('shop.idshop')
            ->get();
        return response()->json(['data' => $data, 'data_penjual' => $data_penjual]);
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
        try {
            DB::table('cart')
                ->updateOrInsert(
                    [
                        'users_id' => $request->get('users_id'),
                        'product_idproduct' => $request->get('product')
                       
                    ],
                    [
                        'qty' => $request->get('qty')
                    ]
                );
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try{
            DB::table('cart')->where('users_id','=', $request->get('users_id'))->where('product_idproduct','=',$request->get('product'))->delete();
            return "berhasil";
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
