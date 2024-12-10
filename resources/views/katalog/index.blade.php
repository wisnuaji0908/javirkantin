@extends('katalog.layout.main')
@section('tile', "Katalog | Kantin Virtual")
@section('content')
    @include('sweetalert::alert')

    {{-- Jumbotron --}}
    <section class="py-5 container" id="jumbotron">
        <div class="row py-5">
            <div class="col-lg-6">
                <h class="fs-1 fw-bold">Kantin Virtual its here !</h>
                <p class="lead text-muted fs-4">Kantin Virtual hadir untuk menjadi wadah informasi bagi siswa SMKN 1 Cibinong yang ingin jajan tetapi mager untuk cek kantin yang buka pada saat itu.</p>
                <p class="lead text-muted fs-4">Jajan lewat Javeer Gampang, Simple & Bikin Kenyang</p>
                <p>
                <a href="#gallery" class="btn btn-primary mt-1">Lihat Toko Yang Tersedia!</a>
                <br>
                <a href="/order" class="btn btn-success mt-1">Cek Pesanan Kamu!</a>
                </p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset("image/main_img.png") }} " width="400px">
            </div>
        </div>
    </section>

    <section class="py-5 "></section>

    {{-- Gallery Toko --}}
    <section id="gallery">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="text-center py-5">
                    <h1>Toko yang tersedia</h1>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach ($katalog as $k)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ asset('image/toko_kantin_virtual.png') }}" width="100%" height="225" alt="Store">

                            <div class="card-body">
                                <input type="hidden" name="id" value="{{ $k->id }}">
                                <p class="card-text fs-5 fw-normal">Nama Toko : <b>{{ $k->nama_toko }}</b></p>
                                <p class="card-text fs-5 fw-normal">Penjual : <b>{{ $k->user->name }}</b></p>
                                <p class="card-text fs-5 fw-normal">Lokasi : <b>Kantin {{ $k->lokasi }}</b></p>
                                <p class="card-text text-muted">Deskripsi Toko : {{ $k->deskripsi_toko }}</p>
                                <p class="card-text text-muted">label:
                                    @if ($k->label==="Makanan")
                                    <span class="badge bg-warning">{{ $k->label }}</span>
                                    @elseif ( $k->label==="Minuman")
                                    <span class="badge bg-primary">{{ $k->label }}</span>
                                    @elseif ( $k->label==="ATK" )
                                    <span class="badge bg-danger">{{ $k->label }}</span>
                                    @else
                                    <span class="badge bg-secondary">{{ $k->label }}</span>
                                    @endif
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        {{-- button cek menu --}}
                                        <button type="button" class="btn btn-primary user-id" data-bs-toggle="modal" id="isi" data-bs-target="#exampleModal" value="{{ $k->user_id }}" onclick="testAgain(this)">Cek Menu</button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $k->nama_toko }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            {{-- sesuaikan dengan field yang dibutuhkan untuk form review menu --}}
                                                                <div class="form-group row">
                                                                    <label for="recipient-name" class="col-form-label col-md-2">Nama Barang</label>
                                                                    <div class="col-md-5">
                                                                        <select class="form-select form-control" aria-label="Default select example" name="lokasiLagi" id="lokasiLagi" required>
                                                                            <option selected disabled>Pilih Barang</option>
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </div>
                                                                    <label for="recipient-name" class="col-form-label col-md-2" id="">Harga</label>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" disabled id="recipient-name hargaLagi">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="form-group row">
                                                                    <label for="recipient-name" class="col-form-label col-md-2" id="">Deskripsi</label>
                                                                    <div class="col-md-10">
                                                                        <textarea class="form-control" value="" disabled id="recipient-name deskripsiLagi"></textarea>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Button form order --}}
                                        <button type="button" class="btn btn-success" value="{{ $k->user_id }}" data-bs-toggle="modal" data-bs-target="#exampleModal1" onclick="test(this)">Pesan Sekarang!</button>
                                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModal1Label">{{ $k->nama_toko }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/order" method="post">
                                                            @csrf
                                                            {{-- buatkan logic disaat input nama barang, muncul harga beserta deskripsinya secara otomatis --}}
                                                            <div class="form-group row mb-3">
                                                                <input type="hidden" name="id_profile" value="{{ $k->id }}">
                                                                {{-- <input type="hidden" name="user_id" value="{{ $k->user_id }}"> --}}
                                                                <label for="recipient-name" class="col-form-label col-md-2">Nama Barang</label>
                                                                <div class="col-md-10">
                                                                    {{-- <input type="hidden" value="{{ $k->user_id }}" name="isi" id="isi"> --}}
                                                                    <select class="form-select form-control" aria-label="Default select example" name="nama_barang" id="lokasi" required>
                                                                        <option selected disabled>Pilih Barang</option>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Harga</label>
                                                                <div class="col-md-10">
                                                                    <input type="number" class="form-control" name="harga" readonly id="recipient-name harga">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Deskripsi</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="desc_barang" readonly id="recipient-name desk"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-3">
                                                                <label for="recipient-name" class="col-form-label col-md-2">Catatan untuk penjual</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="notes"  id="recipient-name"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <button class="btn btn-success rounded me-1" type="submit">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
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
    </section>
    <section class="py-5 bg-light"></section>

@endsection
