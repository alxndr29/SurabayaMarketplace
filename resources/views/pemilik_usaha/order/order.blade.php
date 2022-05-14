@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Orders</h1>
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
                        <th>ID Order</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->idorder}}</td>
                        <td>{{$value->tanggal}}</td>
                        <td>Rp. {{number_format($value->total)}}</td>
                        <td>{{$value->status_order}}</td>
                        <td>
                            <a href="{{route('orderdetail.shop',$value->idorder)}}" class="btn btn-primary">Detail</a>
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