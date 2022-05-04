<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Shop;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        //
        $data = DB::table('booking')->where('users_id', '=', Auth::user()->id)->get();
        //dd($data);
        return view('user_umum.booking.indexbooking', compact('data'));
    }
    public function indexPenjual()
    {
        $shop = new Shop();
        $data = DB::table('booking')->where('shop_idshop', '=', $shop->idshop())->get();
        return view('pemilik_usaha.booking.indexbooking', compact('data'));
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
            DB::table('booking')->insert(
                [
                    'name_customer' => $request->get('namaCustomer'),
                    'name_product' => $request->get('namaProduk'),
                    'jumlah' => $request->get('jumlah'),
                    'total_harga' => $request->get('totalHarga'),
                    'metode_payment' => $request->get('pembayaran'),
                    'metode_pengiriman' => $request->get('pengiriman'),
                    'alamat' => $request->get('alamat'),
                    'date_booking' => $request->get('tanggalPemesanan'),
                    'date_pengambilan' => $request->get('tanggalPengambilan'),
                    'time_pengambilan' => $request->get('waktuPengambilan'),
                    'status' => "Menunggu Barang Diambil",
                    'shop_idshop' => $request->get('idshop'),
                    'users_id' => Auth::user()->id,
                    'product_idproduct' => $request->get('idproduct'),
                    'note' => $request->get('note'),
                    'harga' => $request->get('hargaProduk'),
                    'nama_usaha' => $request->get('namaUsaha')
                ]
            );
            return redirect()->back()->with('sukses', 'Berhasil membuat booking produk');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
        return $request->all();
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
        //return $id;
        try {
            $shop = new Shop();
            $data = DB::table('booking')->where('shop_idshop', '=', $shop->idshop())->update(
                [
                    'status' => 'Selesai'
                ]
            );
            return redirect()->back()->with('sukses', 'Berhasil menyelesaikan booking');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
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
