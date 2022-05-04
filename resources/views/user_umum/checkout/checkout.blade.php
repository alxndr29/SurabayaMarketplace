@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Checkout</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif

@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endsection