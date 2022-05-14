<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function verifikasiPembayaranUser(Request $request)
    {
        try {
            DB::table('payment')->where('idpayment', $request->get('idpayment'))->update(['verified_at' => date("Y-m-d H:i:s")]);
            DB::table('order')->where('idorder', $request->get('idorder'))->update(['status_order' => 'Menunggu Konfirmasi']);
            return redirect()->back()->with('sukses', 'Berhasil Verifikasi Pembayaran');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function ubahStatusOrder(Request $request)
    {
        //kriteria //nilai kriteria
        try {
            if ($request->get('status') == 'Pesanan Diproses') {
                DB::table('order')->where('idorder', $request->get('idorder'))->update(['status_order' => $request->get('status')]);
            }
            if ($request->get('status') == 'Pesanan Dibatalkan') {
                DB::table('order')->where('idorder', $request->get('idorder'))->update(['status_order' => $request->get('status')]);
            }
            if ($request->get('status') == 'Pesanan Dikirim') {
                DB::table('order')->where('idorder', $request->get('idorder'))->update(['status_order' => $request->get('status')]);
            }
            if ($request->get('status') == 'Sampai Tujuan') {
                DB::table('order')->where('idorder', $request->get('idorder'))->update(['status_order' => $request->get('status')]);
            }
            if ($request->get('status') == 'Selesai') {
                DB::table('order')->where('idorder', $request->get('idorder'))->update(['status_order' => $request->get('status')]);
            }
            return redirect()->back()->with('sukses', 'Berhasil Ubah Status Orderan');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function indexShop()
    {
        $shop = new Shop();
        $data = DB::table('order')
            ->join('order_has_product', 'order_has_product.order_idorder', '=', 'order.idorder')
            ->join('product', 'order_has_product.product_idproduct', '=', 'product.idproduct')
            ->where('order.shop_idshop', '=', $shop->idshop())
            ->select('order.*')
            ->groupBy('order.idorder')
            ->get();
        return view('pemilik_usaha.order.order', compact('data'));
    }
    public function detailShop($id)
    {
        $order = DB::table('order')->where('idorder', $id)->first();
        //dd($order);
        $user = DB::table('users')->join('order', 'users.id', '=', 'order.users_id')->select('users.*')->where('order.idorder', $id)->first();
        //dd($user);
        $alamat = DB::table('order')->join('alamat', 'alamat.idalamat', '=', 'order.alamat_idalamat')->where('order.idorder', $id)->select('alamat.*')->first();
        //dd($alamat);
        $data_barang = DB::table('order')
            ->join('order_has_product', 'order.idorder', '=', 'order_has_product.order_idorder')
            ->join('product', 'product.idproduct', '=', 'order_has_product.product_idproduct')
            ->join('product_image', 'product.idproduct', '=', 'product_image.product_idproduct')
            ->where('order.idorder', $id)
            ->select('product_image.name as picture', 'product.name as productname', 'order_has_product.*')
            ->get();
        $payment = DB::table('payment')->where('order_idorder', $id)->first();
        //dd($payment);
        //return $data_barang;
        return view('pemilik_usaha.order.detail', compact('data_barang', 'user', 'alamat', 'order', 'payment'));
    }
    public function detailUser($id)
    {
        // return $id;
        $order = DB::table('order')->where('idorder', $id)->first();
        //dd($order);
        $shop = DB::table('shop')->join('order', 'shop.idshop', '=', 'order.shop_idshop')->select('shop.*')->where('order.idorder', $id)->first();
        //dd($user);
        $alamat = DB::table('order')->join('alamat', 'alamat.idalamat', '=', 'order.alamat_idalamat')->where('order.idorder', $id)->select('alamat.*')->first();
        //dd($alamat);
        $data_barang = DB::table('order')
            ->join('order_has_product', 'order.idorder', '=', 'order_has_product.order_idorder')
            ->join('product', 'product.idproduct', '=', 'order_has_product.product_idproduct')
            ->join('product_image', 'product.idproduct', '=', 'product_image.product_idproduct')
            ->where('order.idorder', $id)
            ->select('product_image.name as picture', 'product.name as productname', 'order_has_product.*')
            ->get();
        $payment = DB::table('payment')->where('order_idorder', $id)->first();

        return response()->json([
            'order' => $order,
            'shop' => $shop,
            'alamat' => $alamat,
            'data_barang' => $data_barang,
            'payment' => $payment
        ]);
    }
    public function indexUser()
    {
        $data = DB::table('order')
            ->join('order_has_product', 'order_has_product.order_idorder', '=', 'order.idorder')
            ->join('product', 'order_has_product.product_idproduct', '=', 'product.idproduct')
            ->join('shop', 'shop.idshop', '=', 'order.shop_idshop')
            ->join('product_image', 'product_image.product_idproduct', '=', 'product.idproduct')
            ->where('order.users_id', '=', Auth::user()->id)
            ->select('order.*', 'product_image.name as picture', 'shop.name as nameshop', 'product.name as nameproduct', 'product.price', DB::raw('count(*) as total_product'))
            ->groupBy('order.idorder')
            ->get();
        return view('user_umum.order.order', compact('data'));
    }
    public function storeReview(Request $request, $id)
    {
        try {
            foreach ($request->get('rating') as $key => $value) {
                // echo $key . $value;
                DB::table('review')->updateOrInsert(
                    ['order_idorder' => $id, 'users_id' =>  Auth::user()->id, 'product_idproduct' => $key],
                    ['star' => $value]
                );
            }
            foreach ($request->get('komen') as $key => $value) {
                // echo $key . $value;
                DB::table('review')->updateOrInsert(
                    ['order_idorder' => $id, 'users_id' =>  Auth::user()->id, 'product_idproduct' => $key],
                    ['message' => $value]
                );
            }
            DB::table('order')->where('idorder', $id)->update(['is_review' => 'true']);
            return redirect()->back()->with('sukses', 'Berhasil Menulis Review Produk');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
        // return $request->all();
        // return $id;
    }
    public function uploadBuktiBayarUser(Request $request, $id)
    {
        try {
            if ($request->hasFile('image')) {


                $imageName = $id . "." . $request->image->extension();

                $request->image->move(public_path('buktibayar'), $imageName);

                DB::table('payment')->updateOrInsert(
                    [
                        'order_idorder' => $id
                    ],
                    [
                        'image' => $imageName,
                        'nama_rekening_pemilik' => $request->get('namaPemilikRekening'),
                        'nomor_rekening_pemilik' => $request->get('nomorRekening')
                    ]
                );
                DB::table('order')->where('idorder', $id)->update(['status_order' => 'Menunggu Verifikasi Pembayaran']);
                return redirect()->back()->with('sukses', 'Berhasil Upload Bukti Transfer');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
