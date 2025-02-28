<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tentang C'May</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-putih">
            <x-navbar></x-navbar>

            <section>
                <div class="relative mt-32 mb-20">
                    <div class="mt-12 w-10/12 h-128 bg-gradient-to-r from-hijau-keruh to-coklat-muda mx-auto">
                        <img src="{{ asset("img/pempekmenu.jpg") }}" alt="" class="w-full h-full opacity-20">
                    </div>
                    <div class="absolute right-0 left-0 top-0 bottom-0 flex items-center justify-center">
                        <h1 class="bg-gradient-to-b from-kuning-keruh to-white inline-block text-transparent bg-clip-text text-8xl font-bold">TENTANG C'MAY</h1>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <section>
                <div class="relative mb-20">
                    <div class="max-w-full h-150 overflow-hidden bg-hijau-tua">
                        <img src="{{ asset("img/pempekmenu.jpg") }}" alt="" class="w-full opacity-20">
                    </div>
                    <div class="absolute top-14 left-0 right-0">
                        <h1 class="text-center text-white text-5xl font-bold mb-7">Tentang C'May</h1>
                        <img src="{{ asset("img/Line_white.png") }}" alt="" class="mx-auto mb-16">
                        <div class="w-4/5 mx-auto">
                            <p class="text-center text-white text-2xl">
                                C'may adalah restoran yang menyajikan pempek asli dari Palembang, 
                                dengan cita rasa yang otentik dan bahan-bahan yang berkualitas. 
                                Sejak didirikan, kami berkomitmen untuk menghadirkan pengalaman kuliner terbaik untuk pelanggan, 
                                baik yang dinikmati di tempat maupun melalui layanan pesan antar. 
                                Kami percaya bahwa makanan bukan hanya soal rasa, 
                                tetapi juga tentang merayakan budaya kuliner yang kaya dan beragam.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <x-footer></x-footer>


    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            @if(Auth::check())
                var pelangganId = {{ Auth::user()->id }};
            @else
                var pelangganId = null;
            @endif
            function updateCartCount() {
                if (pelangganId) {
                    $.ajax({
                        url: '/api/cart/count',
                        method: 'GET',
                        data: { pelanggan_id: pelangganId },
                        success: function(response) {
                            $('#count-cart').text(response.count);
                        },
                        error: function(xhr) {
                            console.error('Kesalahan mengambil jumlah keranjang:', xhr.responseText);
                        }
                    });
                }
            }

            updateCartCount();
        });
    </script>
    
</html>