<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function index(){
        $data = "";
        return view('user_umum.geolocation.geolocation');
    }
    public function data(){
        $data = DB::table('shop')->get();
        return $data;
    }
}
