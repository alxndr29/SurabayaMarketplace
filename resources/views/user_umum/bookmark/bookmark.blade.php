@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Product Bookmark</h1>
@if(Session::has('sukses'))
    <div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
    <div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="d-flex flex-row">
    @foreach ($data as $key => $value)
    <div class="p-2">
        <div class="card h-100 p-2" style="width: 18rem;">
            <img class="card-img-top mx-auto" src="{{asset('product_picture/'.$value->picture)}}" alt="Card image cap" style="width: 200px; height: 200px;">
            <div class="card-body">
                <h5 class="card-title">{{$value->name}}</h5>
                <p class="card-text">Rp. {{number_format($value->price)}}</p>
                <form method="post" action="{{route('bookmarkdelete.user',['id'=>$value->idproduct])}}">
                    @csrf
                    @method('delete')
                    <a href="{{url('user/product/detail/'.$value->idproduct)}}" class="btn btn-primary">Detail</a>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </form>
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