@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Master Product</h1>

<a href="{{route('product.create')}}" class="btn btn-primary btn-icon-split">
    <span class="icon text-white-50">
        <i class="fas fa-flag"></i>
    </span>
    <span class="text">Add Product</span>
</a>
<br>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Product</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th> Picture </th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                            <img style="width:75px;height:75px;" src="{{asset('product_picture/'.$value->picture)}}" class="rounded mx-auto d-block p-1 img-fluid" alt="...">
                        </td>
                        <td><a href="" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form method="post" action="">
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
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection