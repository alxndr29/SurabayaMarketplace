<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Shop;
use Illuminate\Http\Request;

class ShopProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shop = new Shop();
        $data = DB::table('shop_product_category')->where('shop_idshop',$shop->idshop())->get();
        return view('pemilik_usaha.product_category.index', compact('data'));
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
        try{
            $shop = new Shop();
            DB::table('shop_product_category')->insert([
                'name' => $request->get('name'),
                'shop_idshop' => $shop->idshop()
            ]);
            return redirect()->back()->with('message', 'Success add Category');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
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
        try{
            DB::table('shop_product_category')->where('idshop_product_category', $id)->update([
                'name' => $request->get('name')
            ]);
            return redirect()->back()->with('message', 'Success edit Category');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
        // return $request->all();
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
        try{
            DB::table('shop_product_category')->where('idshop_product_category',$id)->delete();
            return redirect()->back()->with('message', 'Success delete Category');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
        
    }
}
