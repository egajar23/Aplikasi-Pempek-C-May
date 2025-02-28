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
                <div class="w-10/12 mt-40 mb-10 mx-auto">
                    <button id="back-cart-btn" class="px-5 py-2 text-pink-keruh text-xl font-bold bg-gradient-to-r from-kuning-muda to-kuning-keruh rounded-full hover:bg-gradient-to-r hover:from-kuning-keruh hover:to-kuning-keruh">&laquo; Batalkan</button>
                    <h3 class="text-pink-keruh text-4xl font-bold mt-4 mb-7">Detail Pengiriman</h3>
                    <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div class="pt-7">
                            <div class="w-11/12 flex justify-between mx-auto">
                                <h3 class="text-3xl font-bold text-hijau mt-1">Penerima : <span id="penerima">-</span></h3>
                                <div class="w-40 h-12 py-2 bg-gradient-to-r from-kuning-muda to-putih rounded-full text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-b hover:from-kuning-muda hover:to-kuning-keruh">
                                    <button class="edit-address-btn text-pink-keruh font-bold text-xl">Ganti Alamat</button>
                                </div>
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-5"></div>

                        <div class="w-11/12 flex justify-between mx-auto mt-7">
                            <p class="w-1/2 text-2xl font-semibold text-hijau mt-3" id="alamat">
                            </p>
                            <div class="mb-7">
                                <h3 class="text-2xl font-semibold text-hijau mb-3">Metode Pengiriman</h3>
                                <div class="w-52 h-14 py-2.5 bg-gradient-to-r from-kuning-muda to-kuning-keruh text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)]">
                                    <select id="shipping-methods" class="w-full text-pink-keruh font-semibold text-m px-3 h-full bg-transparent outline-none appearance-none border-none" style="background-image: url('{{ asset("img/icon.png") }}'); background-repeat: no-repeat; background-position: right 0.75rem center;">
                                        <option disabled selected>Pilih Metode</option>
                                    </select>                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <div class="w-10/12 mt-16 mb-20 mx-auto">
                    <h3 class="text-pink-keruh text-4xl font-bold mb-7">Detail Pesanan</h3>
                    <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div id="pemesanan-id">

                            {{-- <div class="pt-10 grid grid-cols-11">
                                <div class="ml-16 col-span-2 row-span-4 flex items-center">    
                                    <img src="{{ asset("img/lenjer.jpg") }}" alt="" class="w-40 h-40">
                                </div>
                                <div class="ml-5 col-span-8 row-span-4">
                    
                                    <h3 class="ml-2 text-2xl font-semibold text-hijau">Kapal Selam Goreng</h3>
                                        
                                    <div class="mt-3 flex items-center justify-between">
                                        <span class="ml-2 text-2xl font-semibold text-hijau">Qty:</span>
                                        <h3 class="text-2xl font-semibold text-hijau">Rp. 25.000</h3>
                                    </div>
                                    <div class="mt-4 ml-1.5">
                                        <div class="flex items-center justify-center w-12 h-12 border-2 border-solid border-hijau rounded-full">
                                            <span class="font-bold text-xl">2</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-5"></div>

                        <div class="w-11/12 flex justify-between mx-auto mt-7 mb-3">
                            <div class="ml-3">
                                <h3 class="text-2xl font-semibold text-hijau">SubTotal:</h3>
                                <span id="sub-total" class="text-xl font-light">-</span>
                            </div>
                            <div class="mr-16">
                                <span id="total" class="text-2xl font-semibold text-hijau">Rp. 0</span>
                            </div>
                        </div>
                        <div class="w-11/12 flex justify-between mx-auto mb-5">
                            <div class="ml-3">
                                <h3 class="text-2xl font-semibold text-hijau">Biaya Ongkos Kirim</h3>
                            </div>
                            <div class="mr-16">
                                <span id="shipping-cost" data-rate="0" class="text-2xl font-semibold text-hijau">Rp. 0</span>
                            </div>
                        </div>
                        <div class="w-11/12 flex justify-between mx-auto mb-3">
                            <div class="ml-3">
                                <h3 class="text-2xl font-semibold text-hijau">Diskon</h3>
                            </div>
                            <div class="mr-16">
                                <span id="promo" data-rate="0" class="text-2xl font-semibold text-hijau">Rp. 0</span>
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh my-5"></div>
                        <div class="w-11/12 flex justify-between mx-auto mb-7">
                            <div class="ml-3">
                                <h3 class="text-2xl font-semibold text-hijau">Total</h3>
                            </div>
                            <div class="mr-16">
                                <span id="grand-total" class="text-2xl font-semibold text-hijau">Rp. 0</span>
                            </div>
                        </div>
                        <div class="pb-5">
                            <div class="w-10/12 h-15 py-3.5 mx-auto bg-gradient-to-r from-kuning-muda to-kuning-keruh text-center rounded-full shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-b hover:from-kuning-keruh hover:to-kuning-keruh">
                                <button id="pay-btn" class="w-full text-pink-keruh text-xl font-bold">Bayar</button>
                            </div>
                        </div>

                    </div>

                </div>

                <x-footer></x-footer>
                
            </section>

            <div id="AddressModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Alamat
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="AddressModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                            <form id="editForm" class="space-y-4" action="#" method="POST">
                                @csrf
                                <input type="hidden" id="edit-id" name="id">
                                <div>
                                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor HP</label>
                                    <input type="text" name="no_hp" id="edit-no-hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                                <div>
                                    <label for="postal-code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
                                    <input type="text" name="postal_code" id="edit-postal-code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                                <div>
                                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                    <input type="text" name="province" id="edit-province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                                <div>
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota</label>
                                    <input type="text" name="city" id="edit-city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                                <div>
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                    <textarea name="address" id="edit-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                                </div>
                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
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
            let pelangganCity = null
            let grandTotal = 0;
            let totalHarga = 0;

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
                        $('#penerima').empty().html(res.name)
                        $('#alamat').empty().html(`${res.address}, ${res.city}, ${res.province}, ${res.postal_code}, ${res.no_hp}`)
                        pelangganCity = res.city
                        loadShippingMethods(pelangganCity);
                        changeAddress();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal mengambil alamat pelanggan.",
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
            function loadDataPemesanan() {
                
                $.ajax({
                    url: '/api/pemesanans/detail-pemesanan/'+ "{{$pemesanan_id}}" ,
                    method: 'GET',
                    success: function(res) {
                        console.log('res',res);
                        const detailPemesanan = res.detail_pemesanan
                        let subTotal = 0;
                        let totalNoPromo = 0;
                        
                        console.log(detailPemesanan)
                        let el =''
                        detailPemesanan.forEach(val => {

                            const image = val.produk.images[0].image_path
                            let productPrice = val.jumlah * val.harga_satuan

                            subTotal += val.jumlah
                            totalNoPromo += val.jumlah * val.harga_satuan

                            el += `<div class="pt-10 grid grid-cols-11">
                                        <div class="ml-16 col-span-2 row-span-4 flex items-center">    
                                            <img src="{{ asset("product") }}/${image}" alt="" class="w-40 h-40">
                                        </div>
                                        <div class="ml-5 col-span-8 row-span-4">
                                            <div class="mt-3 flex items-center justify-between">
                                                <h3 class="ml-2 text-2xl font-semibold text-hijau">${val.produk.name}</h3>
                                                <h3 class="text-2xl font-semibold text-hijau">${val.jumlah} x ${val.harga_satuan.toLocaleString('id-ID')}</h3>
                                            </div>
                                            <div class="mt-3 flex items-center justify-between">
                                                <span class="ml-2 text-2xl font-semibold text-hijau">Jumlah:</span>
                                                <div>
                                                    <h3 class="text-2xl font-semibold text-hijau">Rp. ${productPrice.toLocaleString('id-ID')}</h3>
                                                </div>
                                            </div>
                                            <div class="mt-4 ml-1.5 flex">
                                                <div class="flex items-center justify-center w-12 h-12 border-2 border-solid border-hijau rounded-full">
                                                    <span class="font-bold text-xl">${val.jumlah}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`

                            
                        });

                        promoDisplay = res.promo_discount == 0 
                                    ? `Rp. ${res.promo_discount.toLocaleString('id-ID')}` 
                                    : `Rp. - ${res.promo_discount.toLocaleString('id-ID')}`

                        $('#pemesanan-id').empty().html(el);
                        $('#sub-total').empty().html(`${subTotal} Items`);
                        $('#total').empty().html(`Rp. ${totalNoPromo.toLocaleString('id-ID')}`);
                        $('#promo').empty().html(promoDisplay);
                        let getShippingRate = $('#shipping-cost').data('rate');
                        
                        totalHarga += res.total_harga;
                        grandTotal = res.total_harga + getShippingRate;
                        $('#grand-total').empty().html(`Rp. ${grandTotal.toLocaleString('id-ID')}`);
                        
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

            function loadShippingMethods(city) {
                $.ajax({
                    url: '/api/shipping-methods',
                    method: 'GET',
                    data: { city: city }, // Kirim data kota ke API
                    success: function(response) {
                        $('#shipping-methods').empty().append('<option disabled selected>Pilih Metode</option>');
                        
                        response.forEach(method => {
                            $('#shipping-methods').append(`
                                <option value="${method.id}" data-name="${method.name}" >${method.name}</option>
                            `);
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal mengambil data metode pengiriman.",
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

            // Fungsi untuk mengambil harga pengiriman
            function getShippingRate(methodId, city) {
                $.ajax({
                    url: `/api/shipping-rates`, // Ubah endpoint sesuai rute API yang sudah dibuat
                    method: 'GET',
                    data: { 
                        method_id: methodId, 
                        city: city 
                    },
                    success: function(response) {
                        $('#shipping-cost').html(`Rp. ${response.rate.toLocaleString('id-ID')}`);
                        grandTotal = totalHarga + response.rate
                        $('#grand-total').empty().html(`Rp. ${grandTotal.toLocaleString('id-ID')}`);
                    },
                    error: function(xhr) {
                        console.error('Error fetching shipping rate:', xhr.responseText);
                        $('#shipping-cost').html('Rp. 0');
                    }
                });
            }

            // Event listener untuk #shipping-methods
            $('#shipping-methods').change(function() {
                const methodId = $(this).val();
                
                if (methodId && pelangganCity) {
                    getShippingRate(methodId, pelangganCity);
                } else {
                    $('#shipping-cost').html('Rp. 0');
                }
            });
            
            updateCartCount();
            loadProfileUsers();
            loadDataPemesanan();

            // Fungsi submit order ketika tombol Bayar ditekan
            function submitOrder() {

                const selectedOption = $('#shipping-methods').find('option:selected');
                if (selectedOption.val() === undefined || selectedOption.is(':disabled')) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal memperbarui pesanan.",
                        text: "Silahkan pilih metode pengiriman!",
                        customClass: {
                            confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    return;
                }
                const shippingMethodId = selectedOption.val();
                const shippingMethodName = selectedOption.data('name');
                const shippingCost = parseInt($('#shipping-cost').text().replace(/[^0-9]/g, ''), 10); // Mengambil ongkir
                
                const totalHarga = grandTotal; 
                let alamatPengguna = $('#alamat').text();

                $.ajax({
                    url: `/api/pemesanans/update-status/${"{{$pemesanan_id}}"}`, // API endpoint untuk memperbarui status pemesanan
                    method: 'POST',
                    data: {
                        status: 'Menunggu Pembayaran',
                        type_pengiriman: shippingMethodName,
                        alamat: alamatPengguna,
                        ongkir: shippingCost,
                        total_harga: totalHarga
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Pesanan berhasil diperbarui ke status Menunggu Pembayaran.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.href = `/cart/pembayaran/${"{{$pemesanan_id}}"}`;
                        }, 1500);
                    },
                    error: function(xhr) {
                        console.error('Error updating order status:', xhr.responseText);
                        Swal.fire({
                            icon: "error",
                            title: "Gagal memperbarui pesanan. Coba lagi.",
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }

            function changeAddress() {
            // Edit Pelanggan
                $('.edit-address-btn').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: `/api/pelanggan`,
                        method: 'GET',
                        data: {
                            pelangganId: pelangganId
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(response) {
                            $('#edit-id').val(response.id);
                            $('#edit-no-hp').val(response.no_hp);
                            $('#edit-postal-code').val(response.postal_code);
                            $('#edit-province').val(response.province);
                            $('#edit-city').val(response.city);
                            $('#edit-address').val(response.address);
                            
                            const modal = new Modal($('#AddressModal')[0]);
                            modal.show();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal mengambil data pelanggan.",
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
            }

            // Edit form submission
            $('#editForm').submit(function(e) {
                    e.preventDefault();

                    // var pelangganId = $('#edit-id').val();
                    var formData = new FormData(this);
                    formData.append('_method', 'PUT');

                    $.ajax({
                        url: '/api/pelanggan/update-address/'+pelangganId,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        
                        success: function(response) {
                            showToast('Alamat berhasil diperbarui.');
                            const modal = new Modal($('#AddressModal')[0]);
                            modal.hide();
                            loadProfileUsers();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal memperbarui alamat.",
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                });

            $('[data-modal-hide="AddressModal"]').click(function() {
                const modal = new Modal($('#AddressModal')[0]);
                modal.hide();
            });

            // Event listener untuk tombol Bayar
            $('#pay-btn').click(function() {
                submitOrder();
            });

            $('#back-cart-btn').click(function() {
                Swal.fire({
                    title: "Apakah Anda yakin ingin membatalkan pesanan?",
                    text: "Pesanan yang dibatalkan akan menghapus produk pada keranjang.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Iya, Batalkan!",
                    cancelButtonText: "Batal"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/pemesanans/delete/' + "{{$pemesanan_id}}",
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                setTimeout(function() {
                                    window.location.href = `/cart`;  
                                }, 1000);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal menghapus pesanan.",
                                    customClass: {
                                        confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                        cancelButton: "btn btn-danger"
                                    },
                                    buttonsStyling: false
                                });
                            }
                        });  
                        Swal.fire({
                            title: "Dibatalkan!",
                            text: "Pesanan berhasil dibatalkan.",
                            icon: "success",
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