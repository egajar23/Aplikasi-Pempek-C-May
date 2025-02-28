<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Produk    C'May</title>

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
                        <h1 class="bg-gradient-to-b from-kuning-keruh to-white inline-block text-transparent bg-clip-text text-8xl font-bold">PRODUK C'MAY</h1>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh"> 
                <div class="flex ml-16 mb-3" id="filter">
                    <a href="javascript:void(0)" class="bg-gradient-to-r from-hijau-toska to-kuning-keruh w-24 h-12 py-2 mr-3 text-center rounded-full text-xl font-extrabold text-kuning-muda hover:text-coklat-muda" data-type="all">Semua</a>
                    <a href="javascript:void(0)" class="bg-abu-abu bg-opacity-80 w-24 h-12 py-2 mr-3 text-center rounded-full hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh text-xl font-bold text-hijau-toska hover:text-kuning-muda" data-type="Frozen">Beku</a>
                    <a href="javascript:void(0)" class="bg-abu-abu bg-opacity-80 w-24 h-12 py-2 mr-3 text-center rounded-full hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh text-xl font-bold text-hijau-toska hover:text-kuning-muda" data-type="Paket">Paket</a>
                    <a href="javascript:void(0)" class="bg-abu-abu bg-opacity-80 w-28 h-12 py-2 mr-3 text-center rounded-full hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh text-xl font-bold text-hijau-toska hover:text-kuning-muda" data-type="Siap Saji">Siap Saji</a>
                </div>

                <div class="border-[7px] border-solid border-hijau-tua w-11/12 mx-auto"></div>

                <div class="w-11/12 mx-auto my-7">
                    <div class="w-full relative">
                        <div class="container grid grid-cols-5 gap-7" id="list-product">
                            
                        </div>
                    </div>
                </div>

                <div class="pagination mb-14 flex justify-center"></div>

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
        $(document).ready(function() {
            @if(Auth::check())
                var pelangganId = {{ Auth::user()->id }};
            @else
                var pelangganId = null;
            @endif
            const baseUrl = "{{url('/')}}"
            let currentType = 'all'; // Default tipe produk

            function loadProducts(type = 'all', page = 1) {
                currentType = type; // Simpan tipe produk yang sedang aktif

                $.ajax({
                    url: '/api/products',
                    method: 'GET',
                    data: { 
                        paginate: 10,
                        type: type !== 'all' ? type : undefined,
                        page: page,
                    },
                    success: function(response) {
                        var productContainer = $('#list-product');
                        productContainer.empty();
                        console.log('response:',response , type);
                        
                        if(response.data.length == 0 ){
                            productContainer.empty().html(`<div class="flex items-center justify-center">Tidak Ada Data!</div>`); 
                            return
                        }

                        response.data.forEach(function(product) {
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
                        });

                        // Tampilkan tombol paginasi
                        generatePagination(response);

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
                    }
                });
            }

            // Fungsi untuk menghasilkan navigasi paginasi
            function generatePagination(response) {
                const paginationContainer = $('.pagination');
                paginationContainer.empty();

                const { current_page, last_page } = response;

                // Tombol Previous
                if (current_page > 1) {
                    paginationContainer.append(`<a href="javascript:void(0)" class="px-3 py-1 mx-1 bg-gray-200 rounded hover:bg-hijau-toska hover:text-white" data-page="${current_page - 1}" data-type="${currentType}">&laquo</a>`);
                }

                // Tombol Halaman
                for (let i = 1; i <= last_page; i++) {
                    paginationContainer.append(`
                        <a href="javascript:void(0)" 
                        class="px-3 py-1 mx-1 rounded ${i === current_page ? 'bg-hijau-toska text-white' : 'bg-gray-200'} ${i === current_page ? 'hover:text-coklat-muda' : 'hover:bg-hijau-toska hover:text-white'}" 
                        data-page="${i}" data-type="${currentType}">
                        ${i}
                        </a>
                    `);
                }

                // Tombol Next
                if (current_page < last_page) {
                    paginationContainer.append(`<a href="javascript:void(0)" class="px-3 py-1 mx-1 bg-gray-200 rounded hover:bg-hijau-toska hover:text-white" data-page="${current_page + 1}" data-type="${currentType}">&raquo</a>`);
                }
            }


            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                const page = $(this).data('page');
                const type = $(this).data('type'); // Ambil tipe produk dari tombol

                loadProducts(type, page); // Muat produk untuk halaman tertentu
            });

            $('#filter a').on('click', function(event) {
                event.preventDefault();

                const type = $(this).data('type');
                $('#filter a').removeClass('bg-gradient-to-r from-hijau-toska to-kuning-keruh text-kuning-muda')
                    .addClass('text-hijau-toska bg-abu-abu bg-opacity-80');
                $(this).removeClass('text-hijau-toska bg-abu-abu bg-opacity-80')
                    .addClass('bg-gradient-to-r from-hijau-toska to-kuning-keruh text-kuning-muda');

                loadProducts(type, 1); // Muat produk untuk tipe tertentu dari halaman pertama
            });
            
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
                                title: "Gagal Menghitung Produk Pada Keranjang.",
                                text: xhr.responseText,
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                            console.error('Kesalahan mengambil jumlah keranjang:', xhr.responseText);
                        }
                    });
                }
            }

            loadProducts();
            updateCartCount(); // Initial cart count update

            // Update cart count after adding an item
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

            $('#filter a').on('click', function(e) {
                e.preventDefault();
                const type = $(this).data('type');

                $('#filter a').removeClass('bg-gradient-to-r from-hijau-toska to-kuning-keruh text-kuning-muda')
                    .addClass('text-hijau-toska bg-abu-abu bg-opacity-80');
            
                // Tambahkan kelas 'active' ke elemen yang diklik
                $(this).removeClass('text-hijau-toska bg-abu-abu bg-opacity-80')
                    .addClass('bg-gradient-to-r from-hijau-toska to-kuning-keruh text-kuning-muda');

                loadProducts(type);
            });


        }); 

    </script>
    
</html>