<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DateTime;

class JadwalController extends Controller
{
    //
    public function indexPenjual()
    {
        $shop = new Shop();
        $data = DB::table('jadwal')
            ->join('shop', 'shop.idshop', '=', 'jadwal.shop_idshop')
            ->leftJoin('users', 'users.id', '=', 'jadwal.users_id')
            ->where('shop.idshop', $shop->idshop())
            ->select('jadwal.*', 'users.name as nameuser', 'shop.name as nameshop', 'shop.address', 'shop.phone', 'shop.latitude', 'shop.longitude')
            ->get();
        return view('pemilik_usaha.jadwal.jadwal',compact('data'));
    }
    public function indexUser()
    {
        $data = DB::table('jadwal')
        ->join('shop','shop.idshop','=','jadwal.shop_idshop')
        ->join('users','users.id','=','jadwal.users_id')
        ->where('users.id', Auth::user()->id)
        ->select('jadwal.*','users.name as nameuser','shop.name as nameshop','shop.address','shop.phone','shop.latitude','shop.longitude')
        ->get();
        //return $data;
        return view('user_umum.jadwal.jadwal', compact('data'));
    }
    public function dataPenjual(){
        $shop = new Shop();
        $data = DB::table('jadwal')->select('title','tanggal as start','idjadwal as id','jam_mulai','jam_akhir','status','time','catatan')->where('shop_idshop','=',$shop->idshop())->get();
        return json_encode($data);
    }
    public function dataPenjualDetailPenjual($id){
        $data = DB::table('jadwal')->select('title', 'tanggal as start', 'idjadwal as id', 'jam_mulai', 'jam_akhir', 'status', 'time', 'catatan')->where('shop_idshop', '=', $id)->get();
        return json_encode($data);
    }
    public function plotJadwalUser(Request $request, $id){
        //  
        $s = explode("/",$request->get('title'));
    
        try{
            DB::table('jadwal')->where('idjadwal','=',$id)->update(
                [
                    'status' => 'terisi',
                    'users_id' => Auth::user()->id,
                    'title' => $s[0]."/"."Slot Penuh",
                    'catatan' => $request->get('catatan')
                ]
            );
            return redirect()->back()->with('sukses', 'Berhasil membuat jadwal temu');
        }catch(\Exception $e){
            return redirect()->back()->with('gagal', $e->getMessage());
        }
        return $id;
    }
    public function storeJadwalPenjual(Request $request)
    {
        $shop = new Shop();
        //$shop->idshop()

        $tanggal = $request->get('tanggal');
        $waktu = $request->get('jamMulai');
        $lama = $request->get('waktupertemuan');
        $slot = $request->get('slot');
        $judul = $request->get('judul');

        $date = new DateTime($tanggal);
        $time = new DateTime($waktu);
        $date->setTime($time->format('H'), $time->format('i'), $time->format('s'));
        //echo $date->format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42'

        $curtime0 = $date->format('Y-m-d H:i:s');
        $curtime1 = $date->format('Y-m-d H:i:s');

        for ($i = 0; $i < $slot; $i++) {
            if ($i == 0) {

                $param0 = "+ 0 minutes";
                $curtime0 = date('Y-m-d H:i', strtotime($param0, strtotime($curtime0)));

                $param1 = "+" . $lama . " minutes";
                $curtime1 = date('Y-m-d H:i', strtotime($param1, strtotime($curtime1)));

                echo substr($curtime0, -5) . " " . substr($curtime1,-5);
                echo '<br>';

                DB::table('jadwal')->insert([
                    'tanggal' => date('Y-m-d', strtotime($param0, strtotime($curtime0))),
                    'title' => substr($curtime0, -5) . " " . substr($curtime1, -5) . "/" . $judul,
                    'jam_mulai' => $curtime0,
                    'jam_akhir' => $curtime1,
                    'status' => "kosong",
                    'shop_idshop' => $shop->idshop(),
                    'time' => date('Y-m-d H:i:s', strtotime($param0, strtotime($curtime0)))
                ]);
            } else {
                $param0 = "+" . $lama . " minutes";
                $curtime0 = date('Y-m-d H:i', strtotime($param0, strtotime($curtime0)));

                $param1 = "+" . $lama . " minutes";
                $curtime1 = date('Y-m-d H:i', strtotime($param1, strtotime($curtime1)));

                echo $curtime0 . " " . $curtime1;
                echo '<br>';

                DB::table('jadwal')->insert([
                    'tanggal' => date('Y-m-d', strtotime($param0, strtotime($curtime0))),
                    'title' => substr($curtime0, -5) . " " . substr($curtime1, -5). "/" . $judul,
                    'jam_mulai' => $curtime0,
                    'jam_akhir' => $curtime1,
                    'status' => "kosong",
                    'shop_idshop' => $shop->idshop(),
                    'time' => date('Y-m-d H:i:s', strtotime($param0, strtotime($curtime0)))
                ]);
            }
        }
    }
}
