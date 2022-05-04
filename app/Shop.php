<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Shop extends Model
{
    //
    protected $table = 'shop';
    protected $primaryKey = 'idshop';

    public function idshop(){
        $data =  DB::table('shop')->where('users_id', Auth::user()->id)->first();
        return $data->idshop;
    }
}
