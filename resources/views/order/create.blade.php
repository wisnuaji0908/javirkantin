@extends('layout.main')
@section('title', "Order Form")
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
                          </div><!-- /.col -->
                          <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                              <li class="breadcrumb-item ">@yield('title')</li>
                            </ol>
                          </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
				</div>
                    <form action="/transaction/book-donations" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="card card-secondary ">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="form-group row mb-3">
                                        <input type="hidden" name="id_profile" value="">
                                        <input type="hidden" name="user_id" value="">
                                        <label for="recipient-name" class="col-form-label col-md-2">Nama Barang</label>
                                        <div class="col-md-10">
                                            <input type="hidden" value="" name="isi" id="isi">
                                            <input type="number" class="form-control" name="harga" readonly id="recipient-name harga">

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
                                            <textarea class="form-control" placeholder="*Opsional* Misalnya : Jangan pakek bawang ya..." name="notes" id="recipient-name"></textarea>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <button class="btn btn-success rounded me-1" type="submit">Masukkan ke keranjang</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
		</div>
	</div>


@endsection



