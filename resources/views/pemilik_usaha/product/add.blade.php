@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Add Product</h1>
<form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="form-group">
        <label>Product Name</label>
        <input type="text" class="form-control" placeholder="Enter name" required name="name">
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="number" class="form-control" placeholder="Enter price" required name="price">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="3" required name="desc"></textarea>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" placeholder="Enter stok" required name="stok">
    </div>
    <div class="form-group">
        <label>Berat</label>
        <input type="number" class="form-control" placeholder="Enter berat" required name="berat">
    </div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category">
            @foreach ($category as $key => $value )
            <option value="{{$value->idcategory}}">{{$value->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Etalase</label>
        <select class="form-control" name="shop_product_category">
            @foreach ($shop_product_category as $key => $value)
            <option value="{{$value->idshop_product_category}}">{{$value->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">picture</label>
        <input type="file" class="form-control-file" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection