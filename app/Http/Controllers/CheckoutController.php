<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Product;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $idShop = $id;
        $alamat = DB::table('alamat')->where('users_id', '=', Auth::user()->id)->get();
        $keranjang =  DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->join('cart', 'cart.product_idproduct', '=', 'product.idproduct')
            ->where('cart.users_id', '=', Auth::user()->id)
            ->where('product.shop_idshop', '=', $id)
            ->select('product.*', 'product_image.name as picture', 'cart.qty as qty')
            ->get();
        //return $keranjang;
        return view('user_umum.checkout.checkout', compact('alamat', 'keranjang', 'idShop'));
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
        DB::beginTransaction();
        try {
            $keranjang =  DB::table('product')
                ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
                ->join('cart', 'cart.product_idproduct', '=', 'product.idproduct')
                ->where('cart.users_id', '=', Auth::user()->id)
                ->where('product.shop_idshop', '=', $request->get('idShop'))
                ->select('product.*', 'product_image.name as picture', 'cart.qty as qty')
                ->get();
            $id = DB::table('order')->insertGetId([
                'users_id' => Auth::user()->id,
                'shop_idshop' => $request->get('idShop'),
                'alamat_idalamat' => $request->get('idAlamat'),
                'status_order' => 'Menunggu Pembayaran'
            ]);
            $total = 0;
            foreach ($keranjang as $key => $value) {
                DB::table('order_has_product')->insert([
                    'order_idorder' => $id,
                    'product_idproduct' => $value->idproduct,
                    'qty' => $value->qty,
                    'subtotal' => ($value->qty * $value->price)
                ]);

                $total = $total + ($value->qty * $value->price);
                DB::table('cart')
                    ->where('product_idproduct', '=', $value->idproduct)
                    ->where('users_id', '=', Auth::user()->id)
                    ->delete();
            }
            DB::table('order')->where('idorder', '=', $id)->update(['total' => $total]);
            DB::commit();
            return $request->all();
        } catch (\Exception $e) {
            DB::rollback();
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
    public function destroy($id)
    {
        //
    }
}
