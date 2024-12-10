<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link rel="stylesheet" href="{{ asset("css/landing.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    @include('sweetalert::alert')

    <header>
        <a href="#" class="logo"><img src="{{ asset("image/logo.png") }}"></a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li>
                <button class="navbar-buttons">
                    <a href="#Home">Home</a>
                </button>
            </li>
            <li>
                <button class="navbar-buttons">
                    <a href="#Kategori">Kategori</a>
                </button>
            </li>
            <li>
                <button class="navbar-buttons">
                    <a href="#About">Order</a>
                </button>
            </li>
            <!-- Menggunakan elemen <button> -->


            <li>
                <button class="navbar-buttons">
                    <a href="/login">Login</a>
                </button>
            </li>
        </ul>

    </header>

    <section id="Home">
        <div class="main">
            <div class="men_text">
                <h1>Kantin Virtual <br>SMKN 1 CIBINONG</h1>
            </div>
            <div class="main_image">
                <img src="{{ asset("image/main_img.png") }}">
            </div>
        </div>
        <p>
            Jajan lewat Javeer Gampang, Simple, Kenyang
        </p>

    </section>


    <!--kategori-->

    <div class="team" id="Kategori">
        <h1><span>Kategori</span></h1>

        <div class="team_box">
            <div class="profile">
                <img src="{{ asset("image/makan.jpg") }}">

                <div class="info">
                    <h2 class="name">Makanan</h2>
                    <p class="bio">Makanan yang enak dan murah.</p>

                </div>

            </div>

            <div class="profile">
                <img src="{{ asset("image/minum.jpg") }}">

                <div class="info">
                    <h2 class="name">Minuman</h2>
                    <p class="bio">Minuman yang segar dan meriah.</p>

                </div>

            </div>

            <div class="profile">
                <img src="{{ asset("image/alat.jpg") }}">

                <div class="info">
                    <h2 class="name">Alat tulis</h2>
                    <p class="bio">Alat tulis seperti buku, pensil dan pulpen.</p>

                </div>

            </div>

            <div class="profile">
                <img src="{{ asset("image/obat.jpg") }}">

                <div class="info">
                    <h2 class="name">Barang Lain</h2>
                    <p class="bio">Barang lain seperti obat dan pembalut.</p>

                </div>

            </div>

        </div>

    </div>

    <!--About-->

    <div class="about" id="About">
        <div class="about_main">

            <div class="image">
                <img src="{{ asset("image/food.png") }}">
            </div>

            <div class="about_text">
                <h1><span>Ayo Pesan</span></h1>
                <h1>Kebutuhanmu!!</h1>
                <p>Lapar? haus? butuh barang lain? atau lupa bawa alat sekolah? <br> Ayo pesan lewat javeer aja
                disini semuanya gampang loh!!</p><br>
                <a href="/login" class="about_btn">Order Now</a>
            </div>

        </div>

    </div>

    <!--Footer-->

    <footer>
        <div class="footer_main">
            <div class="footer2_image">
                <img src="{{ asset("image/sayur.png") }}">
            </div>

            <div class="footer_tag">
                <h2>Kategori</h2>
                <p><i class="ti ti-package"></i> Makanan</p>
                <p><i class="ti ti-cup"></i> Minuman</p>
                <p><i class="ti ti-pencil-alt"></i> Alat Tulis</p>
                <p><i class="ti ti-bag"></i> Barang Lain</p>
            </div>


            <div class="footer_tag">
                <h2>Layanan Kami</h2>
                <p>Pembayaran Tunai di Lokasi</p>
                <p>Pesan Online</p>
                <p></p>
            </div>

            <div class="footer_tag">
                <h2>Jam Operasional</h2>
                <p>Senin-Jumat: 07:00-16:00</p>
                <p>Sabtu-Minggu: Libur</p>
            </div>

            <div class="footer_tag">
                <h2>Kontak</h2>
                <p><i class="fas fa-phone"></i> +62 8821 1464 597</p>
                <p><i class="fas fa-envelope"></i> javeer123@gmail.com</p>
                <p><i class="fas fa-map-marker-alt"></i> SMKN 1 CIBINONG</p>
            </div>
            <p class="end">Kantin Online by<span><i class="fa-solid fa-face-grin"></i> Javeer Team</span></p>
    </footer>




</body>
</html>
