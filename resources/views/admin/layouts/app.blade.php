<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pempek C'May</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <style>
            #dt-length-0{
                width: 65px;
            }
        </style>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
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
        <!-- Header -->
        <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
            <div class="mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <!-- Judul -->
                <h1 class="text-2xl font-semibold text-hijau-toska">Pempek C'May</h1>
        
                <!-- Bagian pengguna dan logout -->
                <div class="flex items-center space-x-4">
                    <!-- Nama pengguna -->
                    <span class="text-base font-medium text-gray-900">Halo, {{ Auth::user()->name }}</span>
                    
                    <!-- Tombol logout -->
                    <div class="px-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button onclick="event.preventDefault(); this.closest('form').submit();" 
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                Keluar
                            </button>
                        </form>
                    </div> 
                </div>
            </div>
        </header>        

        <div class="flex pt-16"> <!-- Added pt-16 to account for the fixed header -->
            <!-- Sidebar -->
            <aside id="sidebar" class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-hijau-toska">
                    <ul class="space-y-2 font-medium mt-6">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-white rounded-lg {{ Request::is('admin/dashboard*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product') }}" class="flex items-center p-2 text-white rounded-lg {{ Request::is('admin/product*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pemesanan') }}" class="flex items-center p-2 justify-between text-white rounded-lg {{ Request::is('admin/pemesanan*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Pemesanan</span>
                                <span class="bg-coklat-muda rounded-full px-2.5 hidden" id="order-active"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.promo') }}" class="flex items-center p-2 text-white rounded-lg {{ Request::is('admin/promo*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Promo</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pelanggan') }}" class="flex items-center p-2 text-white rounded-lg {{ Request::is('admin/pelanggan*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.laporan') }}" class="flex items-center p-2 text-white rounded-lg {{ Request::is('admin/laporan*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Laporan Penjualan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.feedback') }}" class="flex items-center p-2 text-white rounded-lg {{ Request::is('admin/feedback*') ? 'bg-kuning-keruh' : '' }} hover:bg-kuning-keruh">
                                <span class="ml-3">Umpan Balik</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>            

            <!-- Main content -->
            <div class="p-4 sm:ml-64 mt-16 w-full"> <!-- Added w-full for full width -->
                @yield('content')
            </div>
        </div>

        <!-- Sidebar toggle button -->
        <button id="sidebarToggle" class="fixed top-20 left-4 z-50 sm:hidden text-hijau-toska">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>

    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/sorting/datetime-moment.js"></script>


    <script>
         function showToast(message) {
            $('#toast-message').text(message);
            $('#toast-success').removeClass('hidden');

            // Hide the toast after 1 second
            setTimeout(function() {
                hideToast();
            }, 2000);  // 1 second
        }

        function hideToast() {
            $('#toast-success').addClass('hidden');
        }


        function LoadOrdersActive(){
            $.ajax({
                url: '/api/pemesanans',
                method: 'GET',
                success: function(response) {
                        
                    $("#order-active").empty().removeClass("hidden");

                    
                    // console.log(response.alamat[0]);
                    let count = 0;
                    response.forEach(function(order){

                        if(order.status != "Dikonfirmasi" && order.status != "Dibatalkan"){
                            count++;
                        }
                    
                    });
                    
                    if(count == 0){
                        $("#order-active").addClass("hidden");
                    }

                    console.log(count);
                    $("#order-active").text(count);
                        
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal mengambil data pesanan.",
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
        LoadOrdersActive()

    </script>
    @yield('script')


   
</html>