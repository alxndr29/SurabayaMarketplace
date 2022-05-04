<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == "pemilik_usaha") {
            return redirect('/shop');
        } else if (Auth::user()->role == "admin") {
           
        } else if (Auth::user()->role == "user_umum") {
            return redirect('user/home');
         } else if (Auth::user()->role == "sales") { 

         }
        // return view('home');
    }
    public function userIndex(){
        $data = DB::table('product')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->select('product.*', 'product_image.name as picture')
            ->get();
        return view('user_umum.index',compact('data'));
    }
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        if ($request->get('password') != $request->get('password_confirmation')) {
            return redirect()->back()->with('message', 'Password and password confirmation must be same');
        } else {
            if ($request->get('password') == null) {
                DB::table('users')->where('id', '=', $id)->update([
                    'name' => $request->get('name'),
                    'email' => $request->get('email')
                ]);
            } else {
                DB::table('users')->where('id', '=', $id)->update([
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt($request->get('password'))
                ]);
            }
            return redirect()->back()->with('message', 'Success change profile data');
        }
    }
}
