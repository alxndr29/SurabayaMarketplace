<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ProductBookmark extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->join('product_bookmark','product_bookmark.product_idproduct','=','product.idproduct')
            ->where('product_bookmark.users_id','=', Auth::user()->id)
            ->select('product.*', 'product_image.name as picture')
            ->get();
        return view('user_umum.bookmark.bookmark', compact('data'));
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
            DB::table('product_bookmark')
                ->updateOrInsert(
                    [
                        'users_id' => $request->get('users_id'),
                        'product_idproduct' => $request->get('product')
                    ]
                );
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        // return $request->all();
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
        try{
            DB::table('product_bookmark')->where('users_id','=',Auth::user()->id)->where('product_idproduct','=',$id)->delete();
            return redirect()->back()->with('sukses','Berhasil menghapus produk dari bookmark');
        }catch(\Exception $e){
            return redirect()->back()->with('gagal',$e->getMessage());
        }
    }
}
