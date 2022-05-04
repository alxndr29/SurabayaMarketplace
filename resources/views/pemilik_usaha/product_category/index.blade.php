@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Master Category</h1>
<button type="button" data-toggle="modal" data-target="#add-category" class=" btn btn-primary btn-icon-split">
    <span class="icon text-white-50">
        <i class="fas fa-flag"></i>
    </span>
    <span class="text">Add Category</span>
</button>
<br>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->name}}</td>
                        <td><button type="button" data-toggle="modal" data-target="#edit-category-{{$value->idshop_product_category}}" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>
                            <form method="post" action="{{route('shopcategory.destroy',$value->idshop_product_category)}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add-->
<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('shopcategory.store')}}">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->
@foreach ($data as $key => $value)
<div class="modal fade" id="edit-category-{{$value->idshop_product_category}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('shopcategory.put',$value->idshop_product_category)}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category Name" name="name" required value="{{$value->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection