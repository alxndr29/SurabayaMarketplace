@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Orders</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <b> Order Data </b>
                <br>
                {{$order->tanggal}}
                <br>
                Status: <b>{{$order->status_order}}</b>
            </div>
            <div class="col">
                <b> Data Pemesan </b>
                </br>
                {{$user->name}}
                <br>
                {{$user->email}}
            </div>
            <div class="col">
                <b> Data Alamat </b>
                <br>
                {{$alamat->alamat}}
                <br>
                {{$alamat->telepon}}
                <br>
                {{$alamat->latitude, $alamat->longitude}}
            </div>
            <div class="col">
                @if($payment == null)
                Belum Ada Data Pembayaran
                @else
                <b> Data Pembayaran </b>
                <br>
                Tanggal: {{$payment->date}}
                <br>
                {{$payment->nomor_rekening_pemilik}} - {{$payment->nama_rekening_pemilik}}
                <br>
                <a target="_blank" href="{{asset('buktibayar/'.$payment->image)}}"><img style="width:100px; height:100px;" src="{{asset('buktibayar/'.$payment->image)}}"></a>
                <br>
                @if($order->status_order == "Menunggu Verifikasi Pembayaran")
                <form method="post" action="{{route('verifikasipembayaran.shop')}}">
                    @csrf
                    <input type="hidden" name="idorder" value="{{$payment->idpayment}}">
                    <input type="hidden" name="idpayment" value="{{$order->idorder}}">
                    <button type="submit" class="btn btn-primary btn-sm mt-1">Verifikasi Pembayaran</button>
                </form>
                @else
                Verified_at: {{$payment->verified_at }}
                @endif

                @endif
            </div>
        </div>

        <b> Daftar Produk </b>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_barang as $key => $value)
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    <img style="width:100px; height:100px;" src="{{asset('product_picture/'.$value->picture)}}">
                                </td>
                                <td>
                                    {{$value->productname}}
                                </td>
                                <td>
                                    {{$value->subtotal / $value->qty}}
                                </td>
                                <td>
                                    {{$value->qty}}
                                </td>
                                <td>
                                    {{$value->subtotal}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            @if($order->status_order == "Menunggu Konfirmasi")
            <form method="post" action="{{route('ubahstatusorder.shop')}}">
                @csrf
                <input type="hidden" name="idorder" value="{{$order->idorder}}">
                <input type="hidden" name="status" value="Pesanan Diproses">
                <button type="submit" class="btn btn-primary m-1">Proses Pesanan</button>
            </form>
            @endif
            @if($order->status_order == "Menunggu Konfirmasi")
            <form method="post" action="{{route('ubahstatusorder.shop')}}">
                @csrf
                <input type="hidden" name="idorder" value="{{$order->idorder}}">
                <input type="hidden" name="status" value="Pesanan Dibatalkan">
                <button type="submit" class="btn btn-danger m-1">Batal</button>
            </form>
            @endif
            @if($order->status_order == "Pesanan Diproses")
            <form method="post" action="{{route('ubahstatusorder.shop')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <input type="hidden" name="idorder" value="{{$order->idorder}}">
                <input type="hidden" name="status" value="Pesanan Dikirim">
                <button type="submit" class="btn btn-primary m-1">Kirim Pesanan</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // $('#dataTable').DataTable();
    });
</script>
@endsection

<!--
    Menunggu Pembayaran 
    Proses Pesanan
Pesanan Dibatalkan
Pesanan Dikirim
 	Menunggu Konfirmasi
Menunggu Verifikasi Pembayaran
-->