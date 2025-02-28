<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hubungi Kami</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-putih">
        
        <div id="toast-success" class="hidden fixed top-10 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800 " style="z-index: 100;" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1.707-5.293a1 1 0 011.414 0L14 10.414l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L10 9.414l-1.707 1.707a1 1 0 01-1.414-1.414l2-2a1 1 0 011.414 0l2 2z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3 text-sm font-normal" id="toast-message">Produk berhasil ditambahkan.</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" aria-label="Close" onclick="hideToast()">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                
            </button>
        </div>

        <x-navbar></x-navbar>

            <section>
                <div class="relative mt-32 mb-20">
                    <div class="mt-12 w-10/12 h-128 bg-gradient-to-r from-hijau-keruh to-coklat-muda mx-auto">
                        <img src="{{ asset("img/pempekmenu.jpg") }}" alt="" class="w-full h-full opacity-20">
                    </div>
                    <div class="absolute right-0 left-0 top-0 bottom-0 flex items-center justify-center">
                        <h1 class="bg-gradient-to-b from-kuning-keruh to-white inline-block text-transparent bg-clip-text text-8xl font-bold">HUBUNGI KAMI</h1>
                    </div>
                </div>
            </section>

            <section>
                <div class="my-14">
                    <div class="w-1/2 mx-auto">
                    <h3 class="text-center text-hijau-tua font-semibold text-xl">Untuk informasi lebih lanjut, anda dapat menghubungi kami dengan mengisi formulir
                        atau menggunakan informasi kontak kami di bawah ini.</h3>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh"> 
                <section>
                    <div class="w-1/2 bg-gradient-to-b from-hijau-tua to-hijau-keruh mx-auto rounded-xl overflow-auto mb-14">
                        <h1 class="pt-10 text-white text-4xl font-semibold text-center">Apa yang bisa kami tingkatkan?</h1>
                        <div class="mt-12 mb-8 mx-16">
                            <form id="feedbackForm" class="space-y-5" action="#" method="POST">
                                @csrf
                                <div>
                                    <input type="text" name="name" id="name" placeholder="Name" class="rounded-xl w-full">
                                </div>
                                <div>
                                    <input type="email" name="email" id="email" placeholder="Email" class="rounded-xl w-full">
                                </div>
                                <div>
                                    <input type="text" name="subject" id="subject" placeholder="Subject" class="rounded-xl w-full">
                                </div>
                                <div>
                                    <textarea name="message" id="message" placeholder="Message" cols="65" rows="10" class="rounded-xl w-full"></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="w-full h-10 bg-gradient-to-b pt-2 from-kuning-muda to-kuning-keruh rounded-full font-semibold text-center text-hijau-tua hover:bg-gradient-to-b  hover:from-kuning-keruh hover:to-kuning-keruh">Kirim</button>
                                </div>
                            </form>
                        </div>
                </section>

                <x-footer></x-footer>
            </section>

            

    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showToast(message) {
           $('#toast-message').text(message);
           $('#toast-success').removeClass('hidden');
           
           setTimeout(function() {
               hideToast();
           }, 800);
       }

       function hideToast() {
           $('#toast-success').addClass('hidden');
       }

    </script>
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

            $('#feedbackForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '/api/add-feedback',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                        
                    success: function(response) {
                        console.log(response);
                        showToast(response.pesan);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal menambahkan masukan.",
                            text: "Formulir masukan tidak boleh kosong.",
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        
                        // alert('Gagal menambahkan feedback.');
                    }
                });
            });

        });
    </script>
    
</html>