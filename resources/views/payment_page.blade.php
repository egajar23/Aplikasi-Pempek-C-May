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
        <x-navbar></x-navbar>        

            <section>
                <div class="w-10/12 mt-44 mb-20 mx-auto">
                    
                    <h3 class="text-pink-keruh text-4xl font-bold mb-7">Pembayaran</h3>
                    <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div class="pt-5">
                            <div class="w-11/12 mx-auto">
                                <h3 class="text-3xl font-bold text-hijau mt-4">Transfer Bank - Upload Bukti Transfer</h3>
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-5 mb-7"></div>

                        <div class="w-11/12 mx-auto mb-5 text-2xl font-bold text-pink-keruh" id="order-bill"></div>

                        <form id="upload-payment-form" enctype="multipart/form-data">
                            <input type="hidden" name="pemesanan_id" value="{{$pemesanan_id}}">
                            <div class="w-11/12 flex justify-between mx-auto mb-7">
                                <div class="">
                                    <span class="text-2xl font-semibold text-hijau">Bank BCA</span>
                                    <h3 class="text-2xl font-semibold text-hijau">No Rekening: 5234213669</h3>
                                    <span class="text-2xl font-semibold text-hijau inline">Atas Nama: Mau Jullian</span>
                                </div>
                                <div class="">
                                    <h3 class="text-2xl font-semibold text-hijau mb-3">Upload Pembayaran</h3>
                                        <input type="file" name="bukti_transfer" class="mb-3" required>
                                        {{-- <div class="w-52 h-12 py-2.5 bg-gradient-to-r from-putih to-kuning-keruh text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)]">
                                            <button type="submit" class="w-full text-pink-keruh font-semibold text-xl ">
                                                <span class="ml-3">Upload File</span>
                                            </button>
                                        </div> --}}
                                    
                                </div>
                            </div>
                            <div class="pb-5">
                                <div class="w-11/12 h-15 py-3.5 mx-auto bg-gradient-to-r from-kuning-muda to-kuning-keruh text-center rounded-xl shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-b hover:from-kuning-keruh hover:to-kuning-keruh">
                                    <button class="text-pink-keruh text-xl font-bold">Selesaikan Pesanan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <x-footer></x-footer>
            </section>

            

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
                            Swal.fire({
                                icon: "error",
                                title: "Gagal menghitung produk pada keranjang.",
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
            }

            function loadHargaPemesanan() {
                
                $.ajax({
                    url: '/api/pemesanans/show/'+ "{{$pemesanan_id}}" ,
                    method: 'GET',
                    success: function(res) {
                        console.log('res',res);
                        let billContainer = $('#order-bill');
                        billContainer.empty();

                        billContainer.text(`Total yang harus dibayar: Rp. ${res.total_harga.toLocaleString('id-ID')}`)
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal mengambil data pemesanan.",
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

            loadHargaPemesanan();
            updateCartCount();

            // Handle the payment upload form submission
            $('#upload-payment-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this); // Create FormData object

                // Send the form data to the API
                $.ajax({
                    url: '/api/pemesanans/payment-upload', // Ganti dengan URL API Anda
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Pembayaran berhasil dikirim!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.href = `/order/detail-order/${"{{$pemesanan_id}}"}`;
                        }, 1500);

                    },
                    error: function(xhr) {
                        console.error('Error uploading payment:', xhr.responseText);
                        Swal.fire({
                            icon: "error",
                            title: "Terjadi kesalahan saat mengupload pembayaran.",
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
        });
    </script>

</html>