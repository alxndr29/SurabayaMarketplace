<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Shop;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPenjual()
    {
        $shop = new Shop();
        $data = DB::table('chat')
            ->join('users', 'users.id', '=', 'chat.users_id')
            ->join('shop', 'shop.idshop', '=', 'chat.shop_idshop')
            ->where('shop.idshop', $shop->idshop())
            ->groupBy('chat.users_id')
            ->select('chat.*', 'users.name as usersname', 'users.id as usersid')
            ->get();
        //return $data;
        return view('pemilik_usaha.chat.chat', compact('data'));
     }
    public function indexUser()
    {
        $data = DB::table('chat')
            ->join('users', 'users.id', '=', 'chat.users_id')
            ->join('shop', 'shop.idshop', '=', 'chat.shop_idshop')
            ->where('users.id', Auth::user()->id)
            ->groupBy('chat.shop_idshop')
            ->select('chat.*', 'shop.name as shopname','shop.idshop')
            ->get();
        //return $data;
        return view('user_umum.chat.chat',compact('data'));
    }
    public function getChatPenjual($id)
    {
        $shop = new Shop();
        $data = DB::table('chat')
            ->join('users', 'users.id', '=', 'chat.users_id')
            ->join('shop', 'shop.idshop', '=', 'chat.shop_idshop')
            ->where('users.id', $id)
            ->where('shop.idshop', $shop->idshop())
            ->select('chat.*', 'shop.name as shopname', 'shop.idshop', 'users.name as username')
            ->get();
        return $data;
    }
    public function getChatUser($id)
    {
        $data = DB::table('chat')
            ->join('users', 'users.id', '=', 'chat.users_id')
            ->join('shop', 'shop.idshop', '=', 'chat.shop_idshop')
            ->where('users.id', Auth::user()->id)
            ->where('shop.idshop',$id)
            ->select('chat.*', 'shop.name as shopname', 'shop.idshop','users.name as username')
            ->get();
        return $data;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        // return $request->all();
        try {
            DB::table('chat')->insert([
                'isi_chat' => $request->get('isi_chat'),
                'sender' => $request->get('sender'),
                'users_id' => $request->get('users_id'),
                'shop_idshop' => $request->get('shop_idshop')
            ]);
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function storeSeller(Request $request)
    {
        // return $request->all();
        $shop = new Shop();
        try {
            DB::table('chat')->insert([
                'isi_chat' => $request->get('isi_chat'),
                'sender' => $request->get('sender'),
                'users_id' => $request->get('users_id'),
                'shop_idshop' => $shop->idshop()
            ]);
            return "berhasil";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
