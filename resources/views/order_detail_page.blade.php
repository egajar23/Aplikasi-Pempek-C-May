<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pempek C'May</title>

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
                <div class="w-10/12 mt-44 mb-16 mx-auto">
                    <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div class="pt-5">
                            <div class="w-11/12 mx-auto flex items-center mt-4">
                                <h3 class="text-3xl font-bold text-hijau mr-3">Status Pemesanan</h3>
                                {{-- <img src="{{ asset("img/ceklis.png") }}" alt="" class="w-7 h-7"> --}}
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh my-5"></div>

                        <div class="w-11/12 mx-auto pb-5">
                            <h3 class="penerima text-2xl font-semibold text-hijau" id="penerima">Terima Kasih Admin!</h3>
                            <span class="text-2xl font-semibold text-hijau" id="status"></span>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <section>
                    <div class="w-10/12 mb-20 mx-auto">
                        <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                            <div class="pt-5">
                                <div class="w-11/12 mx-auto flex items-center mt-4">
                                    <span class="text-3xl font-bold text-hijau mr-3">Informasi Pelanggan</span>
                                </div>
                            </div>
                            <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh my-5"></div>
                            <div class="w-11/12 flex justify-between mx-auto mt-7">
                                <span class="text-2xl font-semibold text-hijau">Alamat</span>
                                <span class="text-2xl font-semibold text-hijau mb-3">Metode Pengiriman</span>
                            </div>
                            <div class="w-11/12 flex justify-between mx-auto pb-5">
                                <div class="w-1/2">
                                    <span class="penerima text-2xl font-semibold text-hijau" id="penerima">Admin</span>
                                    <p class="text-2xl font-semibold text-hijau" id="alamat">
                                        {{-- Jalan Merdeka raya no 69 pasar rebo, Jakarta 
                                        Selatan, DKI Jakarta, 15423, +6281327459326 --}}
                                    </p>
                                </div>
                                <span class="text-2xl font-semibold text-hijau" id="metode-pengiriman">-</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="w-11/12 mx-auto">
                        <h3 class="mt-20 font-bold text-3xl mb-10">AYO BELI LAGI!</h3>
                        <div class="w-full relative mb-20">
                            <div class="container grid grid-cols-5 gap-7" id="list-product">
                            </div>
                        </div>
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
            const baseUrl = "{{url('/')}}"
            function loadProducts() {
                $.ajax({
                    url: '/api/products',
                    method: 'GET',
                    data :{
                        paginate : 5
                    },
                    success: function(response) {
                        let productContainer = $('#list-product');
                        productContainer.empty();
                        let count = 0;

                        let {data} = response
                        
                        data.forEach(function(product) {
                                const price = typeof product.price === 'string' ? parseFloat(product.price) : product.price;
                                var productHtml = `
                                    <div class="w-64 h-85 block bg-gradient-to-b from-hijau-tua to-hijau-keruh rounded-lg">
                                            <img src="${baseUrl}/product/${product.images[0].image_path}" alt="${product.name}" class="w-44 h-44 pt-5 mx-auto mb-3">
                                        <a href="${baseUrl}/menu/${product.slug}" class="text-white font-bold text-xl ml-2 hover:underline">${product.name}</a>
                                        <h3 class="text-pink-keruh font-semibold text-xl mt-3 mb-7 ml-2">Rp. ${price.toLocaleString('id-ID')}</h3>
                                        <div class="add-to-cart cursor-pointer w-48 h-12 py-2.5 mx-auto bg-gradient-to-b from-white to-kuning-keruh rounded-full text-center hover:bg-gradient-to-b hover:from-kuning-keruh hover:to-kuning-keruh">
                                            <button class="text-hijau-tua font-semibold" data-product-id="${product.id}" data-product-price="${product.price}">Tambah ke Keranjang</button>
                                        </div>
                                    </div>
                                `;
                            productContainer.append(productHtml);
                            count++;
                        });

                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Data Produk.",
                            text: xhr.responseText,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        console.error('Error loading products:', xhr.responseText);
                    }
                });
            }

            loadProducts();

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
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Menghitung Produk pada Keranjang.",
                                text: xhr.responseText,
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                            console.error('Error fetching cart count:', xhr.responseText);
                        }
                    });
                }
            }
            function loadProfileUsers() {
                // var userId = $(this).data('id');
                $.ajax({
                    url: '/api/pelanggan' ,
                    method: 'GET',
                    data: {
                        pelangganId: pelangganId
                    },
                    success: function(res) {
                        console.log(res);
                        $('span.penerima').empty().html(res.name)
                        $('h3.penerima').empty().html("Terima kasih " + res.name)
                        $('#alamat').empty().html(`${res.address}, ${res.city}, ${res.province}, ${res.postal_code}, ${res.no_hp}`)
                        pelangganCity = res.city
                        loadShippingMethods(pelangganCity);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Data Pelanggan.",
                            text: xhr.responseText,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        console.error('Error loading products:', xhr.responseText);
                    }
                });
            }
            function loadStatusPemesanan() {
                // var userId = $(this).data('id');
                $.ajax({
                    url: '/api/pemesanans/status-pemesanan' ,
                    method: 'GET',
                    data: {
                        pelangganId: pelangganId,
                        pemesanan_id:"{{$pemesanan_id}}"
                    },
                    success: function(res) {
                        console.log(res);
                        $('#metode-pengiriman').empty().html(res.type_pengiriman)
                        

                        let noteStatus = '';
                        switch (res.status) {
                            case 'Dibayar':
                                noteStatus = `Pesanan #${res.id} sudah dibayar, mohon menunggu konfirmasi admin.`;
                                break;
                            case 'Dikonfirmasi':
                                noteStatus = `Pesanan #${res.id} sudah terkonfirmasi dan segera disiapkan.`;
                                break;
                            case 'Dibatalkan':
                                noteStatus = `Pesanan #${res.id} telah dibatalkan.`;
                                break;
                            case 'Menunggu Pembayaran':
                                noteStatus = `Pesanan #${res.id} menunggu pembayaran.`;
                                break;
                            default:
                                noteStatus = `Status tidak diketahui.`;
                                break;
                        }
                        $('#status').empty().html(noteStatus);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Data Pesanan.",
                            text: xhr.responseText,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        console.error('Error loading products:', xhr.responseText);
                    }
                });
            }

            $(document).on('click', '.add-to-cart', function() {
                var button = $(this).find('button');
                var productId = button.data('product-id');
                var productPrice = button.data('product-price');
                
                $.ajax({
                    url: '/api/cart/add',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: 1,
                        price: productPrice,
                        pelanggan_id: pelangganId
                    },
                    success: function(response) {
                        showToast('Produk berhasil ditambahkan ke keranjang.');
                        updateCartCount(); // Update cart count after successful addition
                    },
                    error: function(xhr) {
                        let jsonMessage = JSON.parse(xhr.responseText);
                        let messageError = `${jsonMessage.message} dimana stok produk di keranjang ${jsonMessage.current_quantity} melebihi stok produk ${jsonMessage.stock}.` 

                        console.log(messageError);
                        
                        if(pelangganId){
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Menambahkan Produk ke Keranjang.",
                                text: messageError,
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                        }
                        else{
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Menambahkan Produk ke Keranjang.",
                                text: "Anda perlu melakukan login terlebih dahulu.",
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                        }
                    }
                });
            });

            updateCartCount();
            loadProfileUsers();
            loadStatusPemesanan();
        });
    </script>

</html>