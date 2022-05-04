@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Detail Produk</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="row">
    <div class="col-4">
        <div class="card h-100">
            <div class="card-body p-5">
                <img class="card-img-top" src="{{asset('product_picture/'.$data->picture)}}" alt="Card image cap" style="max-width: auto; max-height: auto;">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body p-5">
                <h5 class="card-title">{{$data->name}}</h5>
                <p class="card-text">Rp. {{number_format($data->price)}}</p>
                <p class="card-text">Berat: {{$data->berat}} kg</p>
                <p class="card-text">Stok: {{$data->stok}} Pcs</p>
                <p class="card-text">Deskripsi Produk: {{$data->desc}}</p>
                <p class="card-text">
                    <a href="{{route('home.detailshop',['id' => $data->idshop])}}">Penjual: {{$data->nameshop}}</a>
                </p>
                <p class="card-text">Kategori: {{$data->nama_category}}</p>
                <p hidden name="idproduct">{{$data->idproduct}}</p>
                <p hidden name="qty">1</p>
                <p hidden name="iduser">{{Auth::user()->id}}</p>
                <div class="d-flex flex-row">
                    <div class="p-2">
                        <button class="btn btn-primary btn-submit " onclick="addKeranjang()">Tambah Keranjang</button>
                    </div>
                    <div class="p-2">
                        <input type="number" class="form-control" id="jumlahKeranjang" placeholder="Jumlah" value="1">
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="p-2">
                        <button class="btn btn-primary btn-submit" data-toggle="modal" data-target="#modal-booking">Booking</button>
                    </div>
                    <div class="p-2">
                        <button class="btn btn-primary btn-submit" data-toggle="modal" data-target="#modal-chat">Chat Penjual</button>
                    </div>
                    <div class="p-2">
                        <button class="btn btn-primary btn-submit" onclick="addBookmark()">Bookmark</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Review
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                        <img class="card-img-top mx-auto" src="{{asset('product_picture/'.$data->picture)}}" alt="Card image cap" style="max-width: 150px; max-height: 150px;">
                    </div>
                    <div class="col">
                        Alexander Evan
                        <br>
                        29 Oktober 1999
                        <br>
                        &#9734;&#9734;&#9734;&#9734;
                        <br>
                        Hello World!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Chat -->
<div class="modal fade" id="modal-chat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Kirim Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="">
                <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pesan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Booking -->
<div class="modal fade" id="modal-booking" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('bookingstore.user')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Customer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required name="namaCustomer" value="{{Auth::user()->name}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Usaha</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required name="namaUsaha" readonly value="{{$data->nameshop}}">
                                    <input type="hidden" name="idshop" value="{{$data->idshop}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required name="namaProduk" readonly value="{{$data->name}}">
                                    <input type="hidden" name="idproduct" value="{{$data->idproduct}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" required name="hargaProduk" value="{{$data->price}}" id="hargaProduk" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" required name="jumlah" id="jumlah" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" required name="totalHarga" id="totalHarga" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required name="pembayaran" value="Bayar Ditempat" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pengiriman</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required name="pengiriman" value="Di ambil di tempat" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat Toko</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" readonly name="alamat">{{$data->address}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" required value="<?php echo date('Y-m-d'); ?>" readonly name="tanggalPemesanan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Pengambilan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" required name="tanggalPengambilan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Waktu Pengambilan</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" required name="waktuPengambilan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Note</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        // 
    });
    $("#jumlahKeranjang").change(function() {
        if (this.value > '{{$data->stok}}') {
            // swal('Jumlah produk melebihi kapasitas yang tersedia');
            // $("#jumlahKeranjang").val('{{$data->stok}}');
        }
    });
    $("#jumlah").change(function() {
        if (this.value < 1) {
            swal("Jumlah tidak boleh kurang atau sama dengan 0.");
            $("#jumlah").val(1);
        } else {
            $("#totalHarga").val(this.value * $("#hargaProduk").val());
        }
    });

    function addBooking() {

    }

    function addKeranjang() {
        $.ajax({
            url: "{{route('cartadd.user')}}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                users_id: "{{ Auth::user()->id }}",
                product: "{{$data->idproduct}}",
                qty: $("#jumlahKeranjang").val()
            },
            success: function(response) {
                if (response == "berhasil") {
                    swal("Berhasil Menambah Produk Kedalam Keranjang");
                }
                dataCart();
            },
            error: function(error) {
                swal(error);
            }
        });
    }

    function addBookmark() {
        $.ajax({
            url: "{{route('bookmarkadd.user')}}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                users_id: "{{ Auth::user()->id }}",
                product: "{{$data->idproduct}}"
            },
            success: function(response) {
                if (response == "berhasil") {
                    swal("Berhasil Melakukan Bookmark Produk");
                }
                console.log(response);
            },
            error: function(error) {
                swal(error);
            }
        });
    }

    function myFunction(produk) {
        $(".btn-submit").click(
            function(e) {
                console.log('hello world!');
                console.log("{{ csrf_token() }}");
                //     e.preventDefault();

                //     var iduser = $("input[name=iduser]").val();
                //     var idproduct = $("input[name=idproduct]").val();
                //     var jumlah = $("input[name=qty]").val();

                //     $.ajax({
                //         url: '{{ url('
                //         user / product / detail / {
                //             id
                //         }
                //         /cart') }}',
                //         method: 'POST',
                //         data: {
                //             users_id: iduser,
                //             product: idproduct,
                //             qty: jumlah
                //         },
                //         success: function(response) {
                //             if (response.success) {
                //                 alert(response.message)
                //             } else {
                //                 alert("Error")
                //             }
                //         },
                //         error: function(error) {
                //             console.log(error)
                //         }
                //     });
            }
        );
    }
</script>
@endsection