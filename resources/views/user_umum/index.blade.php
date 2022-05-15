@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Home</h1>
<div class="d-flex flex-wrap">
    @foreach ($data as $key => $value)
    <div class="p-2">
        <div class="card h-100 p-2" style="width: 18rem;">
            <img class="card-img-top mx-auto" src="{{asset('product_picture/'.$value->picture)}}" alt="Card image cap" style="width: 200px; height: 200px;">
            <div class="card-body">
                <h5 class="card-title">{{$value->name}}</h5>
                <p class="card-text">Rp. {{number_format($value->price)}}</p>
                <a href="{{url('user/product/detail/'.$value->idproduct)}}" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endsection