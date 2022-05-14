@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Checkout</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif

<form method="post" action="{{route('checkoutstore.user')}}">
    @csrf
    <div class="card">
        <div class="card-header">
            Checkout
        </div>
        <div class="card-body">
            @if(count($alamat) == 0)
            <a href="{{route('alamat.user')}}"> Tidak ada data alamat. Klik disini untuk menambahkan. </a>
            @else
            <div class="form-group">
                <label> Pilih Alamat</label>
                <select class="form-control" name="idAlamat">
                    @foreach ($alamat as $key => $value)
                    <option value="{{$value->idalamat}}">{{$value->alamat}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            Daftar Produk
            <br>
            @foreach ($keranjang as $key => $value)
            <div class="d-flex flex-row mb-3">
                <div class="p-2">
                    <img style="width:100px; height:100px;" src="{{asset('product_picture/'.$value->picture)}}">
                </div>
                <div class="p-2">
                    <a hhref="{{url('user/product/detail/'.$value->idproduct)}}">{{$value->name}}</a>
                    <br>
                    Harga: Rp. {{number_format($value->price)}}
                    <br>
                    Total Harga: Rp. {{number_format($value->qty * $value->price)}}
                    <br>
                    Jumlah: {{$value->qty}}
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
    </div>
    <input type="hidden" value="{{$idShop}}" name="idShop">
</form>
@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endsection