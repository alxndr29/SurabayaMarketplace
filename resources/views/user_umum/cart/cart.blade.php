@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Cart Keranjang</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif

<div id="listKeranjang">
    <div class="card p-3">
        <div class="card-header">
            Toko A
        </div>
        <div class="card-body">
            <div class="d-flex flex-row mb-3">
                <div class="p-2">
                    <img style="width:100px; height:100px;" src="{{asset('template/img/undraw_profile_1.svg')}}">
                </div>
                <div class="p-2">
                    <a href="">Produk A</a>
                    <br>
                    Harga: Rp. 6000
                    <br>
                    Total Harga: Rp. 18000
                    <br>
                    Jumlah: <input type="number" class="form-control">
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {

        $.ajax({
            url: "{{route('cartindexajaxhalaman.user')}}",
            method: 'GET',
            success: function(response) {
                console.log(response);
                $.each(response.data_penjual, function(h, i) {
                    var a_link = "";
                    var tmp_id = "listproduk-" + i.idshop;
                    console.log(tmp_id);
                    var fe = "";
                    $.each(response.data, function(j, k) {
                        if (i.idshop == k.shop_idshop) {
                            console.log(k.picture);
                            var img = k.picture;
                            var url_image = "{{asset('')}}" + "product_picture/" + img;
                            fe += '<div class="d-flex flex-row mb-3">' +
                                '<div class="p-2">' +
                                '<img style="width:100px; height:100px;" src="' + url_image + '">' +
                                '</div>' +
                                '<div class="p-2">' +
                                '<a href="">' + k.name + '</a>' +
                                '<br>' +
                                'Harga: Rp.' + k.price +
                                '<br>' +
                                'Total Harga: Rp.' + (k.price * k.qty) +
                                '<br>' +
                                'Jumlah: <input type="number" id="ubahQty" value="' + k.qty + '" class="form-control" data-id="' + k.idproduct + '">' +
                                '</div>' +
                                '<div class="p-2"> <button type="button" id="hapusProduk" data-id="' + k.idproduct + '" class="btn btn-primary">Hapus</button> </div>' +
                                '</div>';
                        }
                    });
                    $("#listKeranjang").append(
                        '<div class="card p-3">' +
                        '<div class="card-header">' +
                        i.name +
                        '</div>' +
                        '<div class="card-body">' +
                        fe +
                        '</div>' +
                        '<div class="card-footer text-right">' +
                        '<a href="' + "{{asset('')}}user/checkout/" + i.idshop + '" class="btn btn-primary">Checkout</a>' +
                        '</div>' +
                        '</div>');
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
        $("body").on("click", "#hapusProduk", function(e) {
            var id = $(this).attr('data-id');
            alert(id);
            Swal.fire({
                title: 'Ingin Hapus Produk?',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('cartdestroy.user')}}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            users_id: "{{ Auth::user()->id }}",
                            product: id
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == "berhasil") {
                                location.reload();
                            }
                        },
                        error: function(error) {
                            swal(error);
                        }
                    });
                } else if (result.isDenied) {

                }
            })
        });
        $("body").on("change", "#ubahQty", function(e) {
            var id = $(this).attr('data-id');
            var val = $(this).val()
            Swal.fire({
                title: 'Ingin merubah Qty?',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('cartadd.user')}}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            users_id: "{{ Auth::user()->id }}",
                            product: id,
                            qty: val
                        },
                        success: function(response) {
                            if (response == "berhasil") {
                                location.reload();
                            }
                        },
                        error: function(error) {
                            swal(error);
                        }
                    });
                } else if (result.isDenied) {

                }
            })
        });
    });
</script>
@endsection