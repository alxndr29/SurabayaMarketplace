@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Search</h1>
<div class="row">
    <div class="d-flex flex-row">
        <div class="p-1 mx-auto">
            Hasil Pencarian Produk <b>{{$keyword}}</b> | Filter: Harga
        </div>
        <div class="p-1 mx-auto">
            <select class="form-control" id="comboboxHarga">
                <option selected>Pilih</option>
                <option value="desc">TERTINGGI</option>
                <option value="asc">TERENDAH</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="d-flex flex-wrap">
            @foreach ($data as $key => $value)
            <div class="p-2">
                <div class="card h-100 p-2" style="width: 18rem;">
                    <img class="card-img-top mx-auto" src="{{asset('product_picture/'.$value->picture)}}" alt="Card image cap" style="width: 200px; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$value->name}}</h5>
                        <p class="card-text">Rp. {{number_format($value->price)}}</p>
                        <p class="card-text">{{$value->nameshop}}</p>
                        <a href="{{url('user/product/detail/'.$value->idproduct)}}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- <div class="row">
    @foreach ($data as $key => $value)
    <div class="col">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{asset('product_picture/'.$value->picture)}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$value->name}}</h5>
                <p class="card-text">Rp.{{$value->price}}</p>
                <a href="{{url('user/product/detail/'.$value->idproduct)}}" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div> -->

@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {

    });
    $("#comboboxHarga").on('change', function() {
        alert(this.value);
        window.location.href = "{{url('user/product/search/')}}" + "/" + "{{$keyword}}" + "/" + this.value;
    });
</script>
@endsection