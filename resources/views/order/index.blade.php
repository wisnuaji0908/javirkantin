@extends('layout.main')
@section('title', "Order")
@section('content')
    @include('sweetalert::alert')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mt-2">@yield('title')</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="offset-8">
                        <div class="input-group input-group-sm mb-3">

                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-3">
                        @foreach ($barang as $b)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src={{ asset("/photos/$b->photo") }} width="100%" height="100%" alt="Product">

                                <div class="card-body">
                                    <input type="hidden" name="id" value="">
                                    <p class="card-text fs-5 fw-normal">Nama Produk : {{ $b->barang }}<b></b></p>
                                    <p class="card-text fs-5 fw-normal">Lokasi : Kantin {{ $b->toko->lokasi }}<b></b></p>
                                </div>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-{{ $b->id }}">Buat pesanan +</button>
                                    <div class="modal fade" id="modal-{{ $b->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Form Order</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <form action="/order/store" method="post" enctype="multipart/form-data" onsubmit="return validateForm(event)">
                                                            @csrf
                                                            <div class="form-group row mb-3">
                                                                <input type="hidden" class="form-control" name="id_profile" value="{{ $b->profile_id }}">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Nama Produk</label>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control" name="nama_barang" value="{{ $b->barang }}" id="recipient-name harga" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Harga</label>
                                                                <div class="col-md-10">
                                                                    <input type="number" class="form-control" name="harga" value="{{ $b->harga }}" readonly id="recipient-name harga">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Deskripsi</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="desc_barang" value="{{ $b->desc_barang }}" readonly id="recipient-name desk">{{ $b->desc_barang }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Jumlah</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <button class="btn btn-outline-secondary button-decrement" type="button">-</button>
                                                                        </div>
                                                                        <input type="number" class="form-control stock-input" name="jumlah" value="1" min="1">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-outline-secondary button-increment" type="button">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Catatan untuk penjual</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" placeholder="*Opsional*" name="notes" id="recipient-name"></textarea>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-success rounded me-1" type="submit">Masukkan ke keranjang</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.button-increment').forEach(button => {
                button.addEventListener('click', function() {
                    const stockInput = this.closest('.input-group').querySelector('.stock-input');
                    stockInput.value = parseInt(stockInput.value) + 1;
                });
            });

            document.querySelectorAll('.button-decrement').forEach(button => {
                button.addEventListener('click', function() {
                    const stockInput = this.closest('.input-group').querySelector('.stock-input');
                    if (parseInt(stockInput.value) > 1) {
                        stockInput.value = parseInt(stockInput.value) - 1;
                    }
                });
            });
        });

        function validateForm(event) {
            const jumlahInputs = document.querySelectorAll('.stock-input');
            for (let i = 0; i < jumlahInputs.length; i++) {
                if (parseInt(jumlahInputs[i].value) < 1) {
                    alert('Jumlah barang tidak boleh kurang dari 1.');
                    return false;
                }
            }
            return true;
        }
    </script>

@endsection
