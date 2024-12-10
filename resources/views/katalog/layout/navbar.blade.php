<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-warning " >
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset("image/logo.png") }}"  class="img-circle" width="60px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a class="nav-link active" href="/landing">Home</a>
                </li> --}}
                <li class="nav-item">
                    <a class=" fs-4 nav-link active" href="/landing">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class=" fs-4 nav-link active" href="/katalog">Lihat Toko</a>
                </li>
                <li class="nav-item">
                    <a class=" fs-4 nav-link active" href="/order">Cek Pesanan</a>
                </li>
            </ul>

            <form class="d-flex" method="POST" action="/logout">
                @csrf
                <button class="btn btn-light" type="submit" value="Logout">Logout</button>
            </form>
        </div>
    </div>
</nav>
