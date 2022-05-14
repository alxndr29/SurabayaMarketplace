<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Shop;
use Symfony\Component\VarDumper\Cloner\Data;

class ProductController extends Controller
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
        $data = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->where('product.shop_idshop', $shop->idshop())
            ->select('product.*', 'product_image.name as picture')
            ->get();
        return view('pemilik_usaha.product.index', compact('data'));
    }

    public function detailUser($id)
    {
        $data = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->join('category', 'category.idcategory', '=', 'product.category_idcategory')
            ->join('shop', 'shop.idshop', '=', 'product.shop_idshop')
            ->where('product.idproduct', $id)
            ->select('product.*', 'product_image.name as picture', 'category.name as nama_category', 'shop.idshop as idshop', 'shop.name as nameshop', 'shop.address as address')
            ->first();
        $review = DB::table('review')->join('users', 'users.id', '=', 'review.users_id')->where('review.product_idproduct', $id)->select('review.*', 'users.name as nama')->get();
        //return $review;
        return view('user_umum.detail_produk.detail_produk', compact('data', 'review'));
    }
    public function search($keyword = "", $filter = "asc")
    {
       
        if ($filter == "asc") {
            $data = DB::table('product')
                ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
                ->select('product.*', 'product_image.name as picture', 'shop.name as nameshop')
                ->join('shop', 'shop.idshop', 'product.shop_idshop')
                ->orderBy('product.price', 'asc')
                ->where('product.name', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $data = DB::table('product')
                ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
                ->select('product.*', 'product_image.name as picture', 'shop.name as nameshop')
                ->join('shop', 'shop.idshop', 'product.shop_idshop')
                ->orderBy('product.price', 'desc')
                ->where('product.name', 'like', '%' . $keyword . '%')
                ->get();
                // return "masuk sini";
        }
        //return $data;
        return view('user_umum.product_search.search', compact('data','keyword'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shop = new Shop();
        $category = DB::table('category')->get();
        $shop_product_category = DB::table('shop_product_category')->where('shop_idshop', $shop->idshop())->get();
        return view('pemilik_usaha.product.add', compact('category', 'shop_product_category'));
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
            if ($request->hasFile('image')) {
                $shop = new Shop();
                $id = DB::table('product')->insertGetId([
                    'name' => $request->get('name'),
                    'price' => $request->get('price'),
                    'desc' => $request->get('desc'),
                    'category_idcategory' => $request->get('category'),
                    'shop_product_category_idshop_product_category' => $request->get('shop_product_category'),
                    'shop_idshop' => $shop->idshop(),
                    'berat' => $request->get('berat'),
                    'stok' => $request->get('stok')
                ]);

                // $image = $request->file('picture');
                // $name = time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('/product_picture');
                // $image->move($destinationPath, $name);
                // $this->save();

                $imageName = $id . "." . $request->image->extension();
                DB::table('product_image')->insert([
                    'name' => $imageName,
                    'product_idproduct' => $id
                ]);
                $request->image->move(public_path('product_picture'), $imageName);
            }
            return redirect()->back()->with('message', "Success add product");
        } catch (\Exception $e) {
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
