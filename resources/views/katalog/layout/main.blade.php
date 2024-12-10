<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Katalog</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- CSS Katalog --}}
    <link rel="stylesheet" href="css/katalog.css">

    </head>
    <body>
        <header>
            {{-- navbar --}}
            @include('katalog.layout.navbar')
        </header>

        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('katalog.layout.footer')

        <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>

        <script>

            function test(button){
                const lokasi = document.getElementById('lokasi');
                const harga = document.getElementById('recipient-name harga');
                const desk = document.getElementById('recipient-name desk');
                value = button.value;
                console.log("value: ",value);
                const apiUrl = `/api/barang/${value}`;
                while (lokasi.firstChild) {
                    lokasi.removeChild(lokasi.firstChild);
                }

                lokasi.addEventListener('change', function() {
                const selectedValue = lokasi.value;
                console.log('Nilai yang dipilih:', selectedValue);

                // Kirim request fetch baru di sini
                const apiUrlDetail = `/api/barang/${value}/${selectedValue}`;
                fetch(apiUrlDetail)
                    .then(response => response.json())
                    .then(detailData => {
                        harga.value= detailData[0]['harga'];
                        desk.value= detailData[0]['desc_barang'];
                        console.log('Data detail barang:', detailData);
                    })
                    .catch(error => console.error('Error fetching detail data:', error));
            });

             // Buat elemen kosong tanpa data
                const emptyOption = document.createElement('option');
                emptyOption.value = ''; // Atur nilai kosong
                emptyOption.textContent = 'Pilih Barang'; // Atur teks yang ditampilkan
                lokasi.appendChild(emptyOption); // Tambahkan ke elemen <select>

                fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Iterasi melalui data dan tambahkan setiap barang sebagai opsi dalam elemen select
                    data.forEach(barang => {
                        const option = document.createElement('option');
                        const fill =option.value = barang.barang;
                        option.textContent = barang.barang; // Ganti 'nama' dengan atribut yang sesuai dari model Barang
                        lokasi.appendChild(option);
                        console.log('lokasiVal: ', lokasi.value);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));

                        }

            function testAgain(button){
                const lokasi = document.getElementById('lokasiLagi');
                const harga = document.getElementById('recipient-name hargaLagi');
                const desk = document.getElementById('recipient-name deskripsiLagi');
                value = button.value;
                console.log("value: ",value);
                const apiUrl = `/api/barang/${value}`;
                while (lokasi.firstChild) {
                    lokasi.removeChild(lokasi.firstChild);
                }

                lokasi.addEventListener('change', function() {
                const selectedValue = lokasi.value;
                console.log('Nilai yang dipilih:', selectedValue);

                // Kirim request fetch baru di sini
                const apiUrlDetail = `/api/barang/${value}/${selectedValue}`;
                fetch(apiUrlDetail)
                    .then(response => response.json())
                    .then(detailData => {
                        harga.name="harga"
                        harga.value= detailData[0]['harga'];
                        desk.value= detailData[0]['desc_barang'];
                        console.log('Data detail barang:', detailData);
                    })
                    .catch(error => console.error('Error fetching detail data:', error));
            });

             // Buat elemen kosong tanpa data
                const emptyOption = document.createElement('option');
                emptyOption.value = ''; // Atur nilai kosong
                emptyOption.textContent = 'Pilih Barang'; // Atur teks yang ditampilkan
                lokasi.appendChild(emptyOption); // Tambahkan ke elemen <select>

                fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Iterasi melalui data dan tambahkan setiap barang sebagai opsi dalam elemen select
                    data.forEach(barang => {
                        const option = document.createElement('option');
                        const fill =option.value = barang.barang;
                        option.textContent = barang.barang; // Ganti 'nama' dengan atribut yang sesuai dari model Barang
                        lokasi.appendChild(option);

                    });
                })
                .catch(error => console.error('Error:', error));

            }

        </script>
    </body>
</html>
