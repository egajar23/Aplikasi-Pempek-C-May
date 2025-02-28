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
    <div id="Backdrop" class="hidden fixed inset-0 bg-gray-900/50 dark:bg-gray-900/80 z-50"></div>
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

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <div class="w-10/12 mt-44 mb-20 mx-auto">
                    <h3 class="text-pink-keruh text-4xl font-bold mb-7">Order History</h3>
                    <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div class="pt-10 flex mx-auto ml-12 gap-2" id="filter">
                            <a href="javascript:void(0)" class="p-2 text-center rounded-xl text-xl font-bold bg-gradient-to-r from-hijau-toska to-kuning-keruh  text-kuning-muda hover:text-coklat-muda" data-status="all">Semua</a>
                            <a href="javascript:void(0)" class="text-xl font-bold text-hijau-toska hover:text-kuning-muda bg-abu-abu bg-opacity-80 p-2 text-center rounded-xl hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh group" data-status="Dikonfirmasi">Dikonfirmasi</a>
                            <a href="javascript:void(0)" class="text-xl font-bold text-hijau-toska hover:text-kuning-muda bg-abu-abu bg-opacity-80 p-2 text-center rounded-xl hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh group" data-status="Dibatalkan">Dibatalkan</a>
                            <a href="javascript:void(0)" class="text-xl font-bold text-hijau-toska hover:text-kuning-muda bg-abu-abu bg-opacity-80 p-2 text-center rounded-xl hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh group" data-status="Dibayar">Dibayar</a>
                            <a href="javascript:void(0)" class="text-xl font-bold text-hijau-toska hover:text-kuning-muda bg-abu-abu bg-opacity-80 p-2 text-center rounded-xl hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh group" data-status="Menunggu Pembayaran">Menunggu Pembayaran</a>
                            <a href="javascript:void(0)" class="text-xl font-bold text-hijau-toska hover:text-kuning-muda bg-abu-abu bg-opacity-80 p-2 text-center rounded-xl hover:bg-gradient-to-r hover:from-hijau-toska hover:to-kuning-keruh group" data-status="Pending">Pending</a>
                        </div>

                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-3"></div>

                        <div id="list-order" class="py-10"></div>
                    </div>
                </div>
                <x-footer></x-footer> 
            </section>

            <div id="DetailModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-lg max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-3xl text-pink-keruh font-bold">
                                Detail Transaksi
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="DetailModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
            
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                            <div class="mt-3">
                                <span class="text-hijau-tua text-xl font-semibold" id="modal-order-id">Order #<span id="order-number"></span></span>
                            </div>
            
                            <!-- Status Section -->
                            <div class="w-full flex justify-between mt-5 mb-2">
                                <div>
                                    <span class="text-gray-900 font-normal">Status:</span>
                                </div>
                                <div class="w-1/2">
                                    <div class="p-2 bg-hijau-tua rounded-xl text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)]">
                                        <span class="font-normal text-kuning-muda" id="order-status"></span>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Order Details -->            
                            <div class="w-full flex justify-between items-center mb-2">
                                <div>
                                    <span class="text-gray-900 font-normal">Tanggal Pembelian:</span>
                                </div>
                                <div class="w-1/2">
                                    <span class="font-semibold text-coklat-tua" id="order-date"></span>
                                </div>
                            </div>
            
                            <div class="w-full flex justify-between mb-2">
                                <div>
                                    <span class="text-gray-900 font-normal">Metode Pengiriman:</span>
                                </div>
                                <div class="w-1/2">
                                    <span class="font-semibold text-coklat-tua" id="shipping-method"></span>
                                </div>
                            </div>

                            <div class="w-full flex justify-between mb-5">
                                <div>
                                    <span class="text-gray-900 font-normal my-5">Alamat:</span>
                                </div>
                                <div class="w-1/2">
                                    <p class="font-semibold text-coklat-tua" id="shipping-address"></p>
                                </div>
                            </div>
            
                            <div class="w-11/12 mx-auto border-2 border-solid border-abu-abu mb-5"></div>
            
                            <!-- Product Details -->
                            <div class="mb-3">
                                <span class="text-hijau-tua text-xl font-semibold">Detail Produk</span>
                            </div>
                            <div id="product-details-container">
                                <!-- Product items will be dynamically inserted here -->
                            </div>
            
                            <div class="w-11/12 mx-auto border-2 border-solid border-abu-abu mt-7 mb-5"></div>
            
                            <!-- Payment Details -->
                            <div class="mb-5">
                                <span class="text-hijau-tua text-xl font-semibold">Detail Pembayaran</span>
                            </div>
{{--             
                            <div class="w-full flex justify-between items-center mb-5">
                                <div>
                                    <h3 class="text-gray-900 font-normal">Metode Pembayaran:</h3>
                                </div>
                                <div>
                                    <span class="ml-2 font-semibold text-coklat-tua" id="payment-method"></span>
                                </div>
                            </div> --}}
            
                            <div class="w-full flex justify-between items-center mb-2">
                                <div>
                                    <span class="text-gray-900 font-normal">Total Harga:</span>
                                </div>
                                <div>
                                    <span class="ml-2 font-semibold text-coklat-tua" id="subtotal"></span>
                                </div>
                            </div>
            
                            <div class="w-full flex justify-between mb-2">
                                <div>
                                    <span class="text-gray-900 font-normal">Biaya Ongkos Kirim:</span>
                                </div>
                                <div>
                                    <span class="ml-2 font-semibold text-coklat-tua" id="shipping-cost"></span>
                                </div>
                            </div>
            
                            <div class="w-full flex justify-between mb-5">
                                <div>
                                    <span class="text-gray-900 font-normal">Total Diskon:</span>
                                </div>
                                <div>
                                    <span class="ml-2 font-semibold text-coklat-tua" id="discount"></span>
                                </div>
                            </div>
            
                            <div class="w-full flex justify-between mb-5">
                                <div>
                                    <span class="text-gray-900 font-bold">Total:</span>
                                </div>
                                <div>
                                    <span class="ml-2 font-bold text-coklat-tua" id="total"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="reviewModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Ulasan
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="reviewModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                            <form id="reviewProduct" class="space-y-4" action="#" method="POST">
                                @csrf
                                <!-- Tambahkan ini di dalam form edit sebelum tombol submit -->
                                <div id="product-review-details">
                                </div>
                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Ulasan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showToast(message) {
           $('#toast-message').text(message);
           $('#toast-success').removeClass('hidden');
           
           setTimeout(function() {
               hideToast();
           }, 1200);
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
            let currentOrderId = null;
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

            updateCartCount();

            function loadOrder(status = 'all') {
                $.ajax({
                    url: '/api/pemesanans',
                    method: 'GET',
                    data: { 
                        pelanggan_id: pelangganId, 
                        status: status !== 'all' ? status : undefined
                    },
                    beforeSend:function(){
                        $('#list-order').empty().html(`<div class="flex items-center justify-center">Loading...</div>`); 
                    },
                    success: function(res) {
                        console.log('res:',res);
                        $('#list-order').empty();
                        
                        if(res.length == 0 ){
                            $('#list-order').empty().html(`<div class="flex items-center justify-center">Tidak Ada Data!</div>`); 
                            return
                        }

                        $.each(res, function(index, order) {
                            // console.log(order, order.review.pemesanan_id);
                            // Tentukan status label
                            let statusLabel = order.status
                            let statusColor = order.status === "Dikonfirmasi" ? "bg-hijau-tua" : "bg-coklat-tua";
                            
                            // Format tanggal pemesanan
                            let tanggalPemesanan = new Date(order.tanggal_pemesanan).toLocaleDateString("id-ID", {
                                day: 'numeric', month: 'long', year: 'numeric'
                            });
                            
                            countItems = $.map(order.detail_pemesanan, function (val, i) {
                                    return val.jumlah;
                                }).reduce(function (a, b) {
                                    return a + b;
                                }, 0);

                           let btn = '';
                           let review = '';
                            
                            switch (statusLabel.toLowerCase()) {
                                case 'dibatalkan':
                                        btn +=  `<button class="DetailButton w-full p-1 bg-kuning-keruh rounded text-pink-keruh font-semibold text-xl hover:bg-kuning-muda" data-id="${order.id}">
                                                    <span>Detail</span>
                                                </button>`

                                    break;
                                case 'dikonfirmasi':
                                        btn +=  `<button class="DetailButton ${order.review.length == 0 ? 'w-1/2' : 'w-full'} p-1 bg-kuning-keruh rounded text-pink-keruh font-semibold text-xl hover:bg-kuning-muda" data-id="${order.id}">
                                                    <span>Detail</span>
                                                </button>`
                                        
                                        review += `<button class="review-btn ${order.review.length == 0 ? '' : 'hidden'} w-1/2 p-1 rounded bg-kuning-keruh text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] text-pink-keruh font-semibold text-xl hover:bg-kuning-muda" data-id="${order.id}">
                                                        <span>Ulas</span>
                                                    </button>`
                                    break;
                                case 'pending':
                                        btn +=  `<a class=" p-1 w-full rounded bg-kuning-keruh text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] text-pink-keruh font-semibold text-xl hover:bg-kuning-muda" href="/cart/pengiriman/${order.id}">
                                                   Pergi menuju Halaman Detail Pengiriman
                                                </a>`
                                    
                                    break;
                                case 'menunggu pembayaran':
                                        btn +=  `<a class=" p-1 w-full rounded bg-kuning-keruh text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] text-pink-keruh font-semibold text-xl hover:bg-kuning-muda" href="/cart/pembayaran/${order.id}">
                                                    Pergi menuju Halaman Pembayaran
                                                </a>`
                                    
                                    break;
                            
                                default:
                                    btn +=  `<a class=" p-1 w-full rounded bg-kuning-keruh text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] text-pink-keruh font-semibold text-xl hover:bg-kuning-muda" href="/order/detail-order/${order.id}">
                                                    Pergi menuju Halaman Detail Pemesanan
                                                </a>`
                                    break;
                            }

                            // Template order item
                            let orderItem = `
                                <div class="grid grid-cols-12">
                                    <div class="col-start-2 col-span-10 row-span-4">
                                        <div class="flex items-center justify-between mb-5">
                                            <div class="flex items-center">
                                                <div class="p-2 ${statusColor} rounded-xl text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)]">
                                                    <span class="text-xl font-normal text-kuning-muda">${statusLabel}</span>
                                                </div>
                                            </div>
                                            <span class="ml-2 text-xl pb-1.5 font-semibold text-coklat-tua">${tanggalPemesanan}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="ml-2 text-2xl font-semibold text-hijau">Pembelian<span class="ml-2 text-xl pb-1 font-semibold">Order #${order.id}</span></h3>
                                                <span class="ml-2 text-xl font-light">Sebanyak ${countItems} Produk</span>
                                            </div>
                                            <div>
                                                <span class="text-2xl font-semibold text-hijau">Total Harga</span>
                                                <h3 class="text-2xl font-semibold text-hijau">Rp. ${order.total_harga.toLocaleString('id-ID')}</h3>
                                            </div>
                                        </div>
                                        
                                            
                                            <div class="mt-7 w-full flex items-center justify-center space-x-5">
                                                ${review}
                                                ${btn}
                                            </div>
                                        

                                    </div>
                                </div>
                                <div class="row-start-5 col-span-12 w-10/12 mx-auto border-2 border-solid border-pink-keruh my-8"></div>
                            `;

                            // Tambahkan orderItem ke list-order
                            $('#list-order').append(orderItem);
                             // Re-bind click event after dynamically adding elements
                            $('.DetailButton').click(function() {
                                const modal = new Modal($('#DetailModal')[0]);
                                const idPemesanan = $(this).data('id')
                                detailOrder(modal,idPemesanan)
                            });
                            $('.review-btn').click(function() {
                                const modalReview = new Modal($('#reviewModal')[0]);
                                const idPemesanan = $(this).data('id')
                                currentOrderId = idPemesanan
                                reviewProductItems(modalReview,idPemesanan)
                            });
                        });
                        
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
                        console.error('Error fetching cart count:', xhr.responseText);
                    }
                });
            }

            function detailOrder(modal, id) {
                $.ajax({
                    url: '/api/pemesanans/detail-pemesanan/' + id,
                    method: 'GET',
                    success: function(response) {
                        // Update basic order information
                        $('#order-number').text(response.id);
                        $('#order-status').text(response.status);
                        $('#order-receiver').text(response.penerima);
                        $('#order-date').text(new Date(response.tanggal_pemesanan).toLocaleString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        }) + ' WIB');
                        $('#shipping-method').text(response.type_pengiriman);
                        $('#tracking-number').text(response.nomor_resi || '-');
                        $('#shipping-address').text(response.alamat);
                        let total = 0;
                        // Clear and update product details            
                        $('#product-details-container').empty();
                        response.detail_pemesanan.forEach(function(item) {
                            hargaProduk = item.produk.price
                            imgPath = "{{asset('product')}}"
                            total += item.jumlah * hargaProduk;
                            const productHtml = `
                                <div class="grid grid-cols-12 mt-2">
                                    <div class="col-span-2 row-span-4 flex items-center">    
                                        <img src="${imgPath}/${item.produk.images[0].image_path}" alt="${item.produk.nama}" class="w-20 h-20">
                                    </div>
                                    <div class="col-span-10 row-span-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="ml-2 text-xl font-semibold text-gray-900">${item.produk.name}</h3>
                                                <span class="ml-2 text-xs font-light text-gray-900">${item.jumlah} produk x ${hargaProduk.toLocaleString('id-ID')}</span>
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-semibold text-coklat-tua">Total Harga</h3>
                                                <span class="text-xs text-coklat-tua">Rp. ${(item.jumlah * hargaProduk).toLocaleString('id-ID')}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#product-details-container').append(productHtml);
                        });

                        let promoDiscount = response.promo_discount == 0
                                            ? 'Rp. ' + response.promo_discount.toLocaleString('id-ID')
                                            : 'Rp. - ' + response.promo_discount.toLocaleString('id-ID')

                        // Update payment details
                        $('#payment-method').text(response.metode_pembayaran);
                        $('#subtotal').text('Rp. ' + total.toLocaleString('id-ID'));
                        $('#shipping-cost').text('Rp. ' + response.ongkir.toLocaleString('id-ID'));
                        $('#discount').text(promoDiscount);
                        $('#total').text('Rp. ' + response.total_harga.toLocaleString('id-ID'));

                        // Show the modal
                        // modal.show();
                        $('#DetailModal').removeClass('hidden').addClass('flex');
                        // $('#reviewModal').removeClass('hidden').addClass('flex');
                        $('#Backdrop').removeClass('hidden'); // Menampilkan backdrop

                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Detail Pesanan.",
                            text: xhr.responseText,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        console.error('Error fetching order details:', xhr.responseText);
                    }
                });
            }

            function reviewProductItems(modal, id) {
                $.ajax({
                    url: '/api/pemesanans/detail-pemesanan/' + id,
                    method: 'GET',
                    success: function(response) {
                        // console.log(response, id)

                        // Clear and update product details
                        $('#product-review-details').empty();
                        response.detail_pemesanan.forEach(function(item) {
                            hargaProduk = item.produk.price
                            imgPath = "{{asset('product')}}"
                            const productHtml = `
                                <div class="mt-5">
                                    <div class="">    
                                        <h3 class="text-xl font-semibold text-gray-900 mb-3">${item.produk.name}</h3>
                                        <img src="${imgPath}/${item.produk.images[0].image_path}" alt="${item.produk.nama}" class="w-1/2 h-40 mx-auto">
                                    </div>
                                    <div class="mt-5">
                                        <input type="hidden" name="product_id[]" value="${item.produk.id}">
                                        <input type="hidden" name="user_id" value="${pelangganId}">
                                        <div class="mb-5">
                                            <label for="add-bintang" class="mr-2">Nilai Produk:</label>
                                            <select id="add-bintang" name="bintang[]">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="add-ulasan" class="block mb-2 font-medium text-gray-900 dark:text-white">Apa kamu puas dengan produk ini?</label>
                                            <textarea name="ulasan[]" id="add-ulasan" placeholder="Contoh: sangat enak, rasa tidak ada duanya" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#product-review-details').append(productHtml);
                        });

                        // Update payment details

                        // Show the modal
                        // modal.show();
                        $('#reviewModal').removeClass('hidden').addClass('flex');
                        $('#Backdrop').removeClass('hidden'); // Menampilkan backdrop

                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Detail Pesanan.",
                            text: xhr.responseText,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        console.error('Error fetching order details:', xhr.responseText);
                    }
                });
            }

            $('#reviewProduct').submit(function(e) {
                    e.preventDefault();
                    
                    // var pelangganId = $('#edit-id').val();
                    var formData = $(this).serialize();
                    // formData.append('pelangganId', pelangganId);
                    
                    $.ajax({
                        url: '/api/add-reviews',
                        method: 'POST',
                        data: {
                            formData,
                            pemesanan_id: currentOrderId,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        
                        success: function(response) {
                            console.log(response);
                            
                            showToast('Ulasan berhasil disimpan.');

                            // Sembunyikan tombol Review untuk order yang sedang diproses
                            // $(`.review-btn[data-id="${currentOrderId}"]`).addClass('hidden');

                            // // Ubah tombol Detail menjadi full-width
                            // $(`.DetailButton[data-id="${currentOrderId}"]`).removeClass('w-1/2').addClass('w-full');

                            const modal = new Modal($('#reviewModal')[0]);
                            $('#Backdrop').addClass('hidden'); // Menyembunyikan backdrop
                            modal.hide();
                            loadOrder();
                            // window.location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Menambahkan Review Produk.",
                                text: xhr.responseText,
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                });


            
            $('[data-modal-hide="DetailModal"]').click(function() {
                $('#DetailModal').addClass('hidden').removeClass('flex');
                $('#Backdrop').addClass('hidden'); // Menyembunyikan backdrop

            });

            $('[data-modal-hide="reviewModal"]').click(function() {
                $('#reviewModal').addClass('hidden').removeClass('flex');
                $('#Backdrop').addClass('hidden'); // Menyembunyikan backdrop

            });


            $('#filter a').on('click', function(e) {
                e.preventDefault();
                const status = $(this).data('status');

                $('#filter a').removeClass('bg-gradient-to-r from-hijau-toska to-kuning-keruh text-kuning-muda')
                      .addClass('text-hijau-toska bg-abu-abu bg-opacity-80');
        
                // Tambahkan kelas 'active' ke elemen yang diklik
                $(this).removeClass('text-hijau-toska bg-abu-abu bg-opacity-80')
                    .addClass('bg-gradient-to-r from-hijau-toska to-kuning-keruh text-kuning-muda');

                loadOrder(status);
            });

            loadOrder();
        });
    </script>
    
</html>