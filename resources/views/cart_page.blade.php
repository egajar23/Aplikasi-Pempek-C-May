<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Keranjang</title>

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
                <div class="w-10/12 mt-44 mb-10 mx-auto">
                    <h3 class="text-pink-keruh text-4xl font-bold mb-7">Keranjang</h3>
                    <div id="cart-container" class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div class="pt-10 flex justify-between">
                            <div class="w-40 h-12 ml-12 py-2 bg-gradient-to-r from-kuning-muda to-putih rounded-full text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-b hover:from-kuning-muda hover:to-kuning-keruh">
                                <button class="select-all-button text-pink-keruh font-semibold text-xl">Pilih semua</button>
                            </div>
                            <div class="w-40 h-12 mr-12 py-2 bg-gradient-to-r from-coklat-muda to-coklat-tua rounded-full text-center shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-b hover:from-coklat-tua hover:to-coklat-tua">
                                <button class="delete-cart-item text-kuning-keruh font-semibold text-xl">Hapus Pilihan</button>
                            </div>
                        </div>

                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-5"></div>

                        <div class="mt-10" id="list-cart-container">
                            
                           
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-10"></div>
                        <div class="grid grid-cols-12 my-5">
                            <div class="col-start-2 col-span-10 display-promo">
                                {{-- <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-semibold text-hijau">Diskon:</span>
                                        <h3 class="font-normal text-coklat-tua">Diskon Ramadhan Sale</h3>
                                    </div>
                                    <h3 class="text-2xl font-semibold text-hijau diskon-cart" >Rp. 0</h3>
                                </div> --}}
                            </div>
                            <div class="col-start-2 col-span-10">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-semibold text-hijau">Total</span>
                                    <h3 class="text-2xl font-semibold text-hijau total-cart" >Rp. 0</h3>
                                </div>
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh"></div>
                        
                        <div class="grid grid-cols-12">
                            <div class="col-span-12">
                                <div class="flex items-center justify-between mt-5">
                                    <div class="pb-6 ml-14">
                                        <button class="w-32 h-12 bg-hijau-tua rounded-full flex justify-center items-center cursor-pointer hover:bg-gradient-to-b hover:from-hijau-muda hover:to-hijau-tua" id="promoButton">
                                            <span class="text-kuning-muda text-xl">PROMO</span>
                                        </button>  
                                    </div>                              
                                    <div class="pb-6 mr-14">
                                        <button class="w-36 h-12 bg-abu-abu rounded-full flex items-center cursor-pointer hover:bg-gray-400" id="notesButton">
                                            <span class="ml-5">CATATAN</span>
                                            <img src="{{ asset("img/edit.png") }}" alt="edit-pict" class="w-6 h-6 ml-3">
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center pb-7 mt-3">
                            <button  id="checkout-btn" class="w-11/12 h-16 py-4 bg-gradient-to-r from-coklat-muda to-coklat-tua rounded-full text-center text-kuning-keruh font-extrabold text-xl shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-b hover:from-coklat-tua hover:to-coklat-tua">PESAN</button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <section>
                    <div class="w-11/12 mx-auto">
                        <h3 class="mt-20 font-bold text-3xl mb-10">REKOMENDASI PRODUK</h3>
                        <div class="w-full relative mb-20">
                            <div class="container grid grid-cols-5 gap-7" id="list-product">
                            </div>
                        </div>
                    </div>
                </section>

                <x-footer></x-footer>

                
            </section>

            <div id="notesModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Catatan
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="notesModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                                <div>
                                    <textarea name="notes" id="add-notes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-5" placeholder="Catatan"></textarea>
                                </div>
                                <button type="button" id="notesProduct" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 text-center">Simpan Catatan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="promoModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Promo
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="promoModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0 grid grid-cols-12 mt-5 gap-x-3" id="promo-details">
                        </div>
                        <div class="w-full mx-auto flex justify-center pb-5" id="display-cancel-promo">
                            <button class="w-10/12 h-10 rounded-xl bg-gradient-to-r from-coklat-muda to-coklat-tua hover:bg-gradient-to-r hover:from-coklat-tua hover:to-coklat-tua" id="cancel-promo">Batalkan Promo</button>
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
        $(document).ready(function() {
            
            @if(Auth::check())
                var pelangganId = {{ Auth::user()->id }};
            @else
                var pelangganId = null;
            @endif
            const baseUrl = "{{url('/')}}"
            let discount_promo = 0;
            let notes;
            let pelangganMember = {{ Auth::user()->membership }};
            let cartProductId = [];
            let produkIdfromPromo;
            let successPromoMember;
            let percentageProductDiscount = 0;
            let typeDiscountMember;
            let maximumDiscountMember;

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
                                        <h3 class="text-pink-keruh font-semibold text-xl mt-3 mb-7 ml-2">Rp. ${price.toLocaleString()}</h3>
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
                            title: "Gagal mengambil data produk.",
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

            
            function listCart() {
                // Simpan state checkbox sebelum list di-refresh
                const selectedCheckboxes = [];
                $('.item-checkbox:checked').each(function() {
                    selectedCheckboxes.push($(this).closest('.list-cart').data('cartitemid'));
                });

                $.ajax({
                    url: '/api/cart',
                    method: 'GET',
                    data: { id: pelangganId },
                    success: function(res) {
                        $('#list-cart-container').empty();

                        if (res.status == 'failed' || res.items.length == 0) {
                            el = `<div class=" p-4 flex items-center justify-center">Tidak Ada Data</div>`
                            $('#cart-container').empty().html(el);

                            return
                            
                        }
                        
                        let total = 0;

                        res.items.forEach(function(item, index) {
                            
                            cartProductId.push(item.product.id);
                            
                            const imageUrl = item.product.images.length > 0 
                                ? item.product.images[0].image_path 
                                : '/img/placeholder.jpg';

                            const subtotal = item.quantity * item.price;
                            const isLastItem = index === res.items.length - 1;

                            // Define button styles based on disabled state
                            const minusButtonStyle = item.quantity <= 1 ? 
                                'pl-4 pb-2 text-4xl btn-minus text-gray-300 cursor-not-allowed' : 
                                'pl-4 pb-2 text-4xl btn-minus text-black cursor-pointer';

                            const plusButtonStyle = item.quantity >= item.product.stock ? 
                                'pr-4 pb-2 text-4xl btn-plus text-gray-300 cursor-not-allowed' : 
                                'pr-4 pb-2 text-4xl btn-plus text-black cursor-pointer';

                            const cartItem = `
                                <div class="list-cart grid grid-cols-12" data-cartitemid="${item.id}" data-price="${item.price}" data-quantity="${item.quantity}" data-produkid="${item.product_id}" data-subtotal ="${subtotal}">
                                    <div class="ml-10 col-span-1 row-span-4 flex items-center justify-center">
                                        <input type="checkbox" class="item-checkbox w-7 h-7" data-subtotal="${subtotal}">
                                    </div>
                                    <div class="ml-3 col-span-2 row-span-4 flex items-center">    
                                        <img src="${baseUrl}/product/${imageUrl}" alt="${item.product.name}" class="w-40 h-40 object-cover">
                                    </div>
                                    <div class="col-span-8 row-span-4">
                                        <div class="flex items-center justify-between">
                                            <h3 class="ml-2 text-2xl font-semibold text-hijau">${item.product.name}</h3>
                                            <div>
                                                <span class="text-2xl font-semibold text-hijau promo-added-${item.product.id}">Rp. ${subtotal.toLocaleString('id-ID')}</span>
                                                <h3 class="hidden text-2xl font-semibold text-hijau price-promo-${item.product.id}">Rp. ${subtotal.toLocaleString('id-ID')}</h3>
                                            </div>
                                        </div>
                                        <div class="mt-3 flex items-center justify-between">
                                            <span class="ml-2 text-2xl font-semibold text-hijau">Jumlah:</span>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex items-center justify-between w-40 h-14 border-2 border-solid border-hijau rounded-full">
                                                <button class="${minusButtonStyle}" 
                                                        data-item-id="${item.id}" 
                                                        ${item.quantity <= 1 ? 'disabled' : ''}>-</button>
                                                <h3 class="font-bold text-xl">${item.quantity}</h3>
                                                <button class="${plusButtonStyle}" 
                                                        data-item-id="${item.id}"
                                                        ${item.quantity >= item.product.stock ? 'disabled' : ''}>+</button>
                                            </div>
                                        </div>
                                        ${item.product.stock < 3 ? `
                                            <div class="mt-2 text-red-500">
                                                Only ${item.product.stock} items left in stock!
                                            </div>
                                        ` : ''}
                                    </div>
                                    ${!isLastItem ? `
                                        <div class="row-start-5 col-span-12 w-10/12 mx-auto border-2 border-solid border-pink-keruh my-8"></div>
                                    ` : ''}
                                </div>
                            `;

                            $('#list-cart-container').append(cartItem);
                        });

                         // Pulihkan state checkbox yang terpilih
                         selectedCheckboxes.forEach(function(cartItemId) {
                            $(`.list-cart[data-cartitemid="${cartItemId}"] .item-checkbox`).prop('checked', true);
                        });
                        
                        // Calculate total based on selected checkboxes
                        function updateTotal() {
                            let selectedTotal = 0;
                            
                            $('.item-checkbox:checked').each(function() {
                                selectedTotal += parseInt($(this).data('subtotal'), 10);
                            });

                            if(isPromoId != undefined && isPromoId != 0 && selectedTotal != 0){
                                if(produkIdfromPromo){

                                    $(`.promo-added-${produkIdfromPromo}`).addClass("line-through");
                                    $(`.price-promo-${produkIdfromPromo}`).removeClass("hidden");
                                    $(`.price-promo-${produkIdfromPromo}`).empty();
    
                                    let subtotal = $(`.promo-added-${produkIdfromPromo}`)
                                        .closest('.list-cart') 
                                        .data('subtotal');
                                    let totalWithPromo = 0
                                    console.log('discount_promo cart1:',subtotal,discount_promo)
                                    if(typeDiscountMember == "Ammount"){
                                         totalWithPromo = subtotal - discount_promo;
                                        $(`.price-promo-${produkIdfromPromo}`).text(`Rp. ${totalWithPromo.toLocaleString('id-ID')}`);
                                    }else{
                                       
                                        if(percentageProductDiscount != 0){
    
                                            let totalPersentage = (subtotal * percentageProductDiscount)/100;
    
                                            if(totalPersentage > maximumDiscountMember){
                                                totalPersentage = maximumDiscountMember;
                                            }
    
                                            totalWithPromo = subtotal - totalPersentage;
                                            discount_promo = totalPersentage
                                            $(`.price-promo-${produkIdfromPromo}`).text(`Rp. ${totalWithPromo.toLocaleString('id-ID')}`);
                                        }
                                        console.log('discount_promo cart:',subtotal,discount_promo)
                                    }
                                    $('.diskon-cart').empty().html(`Rp. ${discount_promo.toLocaleString('id-ID')}`);
                                }else{
                                    let totalWithPromo = 0
                                    
                                    if(typeDiscountMember == "Ammount"){
                                        console.log('discount_promo cart id null:',discount_promo)
                                    }else{
                                        if(percentageProductDiscount != 0){
    
                                            let totalPersentage = (selectedTotal * percentageProductDiscount)/100;
    
                                            if(totalPersentage > maximumDiscountMember){
                                                totalPersentage = maximumDiscountMember;
                                            }
    
                                            totalWithPromo = selectedTotal - totalPersentage;
                                            discount_promo = totalPersentage
                                        }
                                        console.log('discount_promo cart id null:',percentageProductDiscount,discount_promo, maximumDiscountMember)

                                    }
                                    $('.diskon-cart').empty().html(`Rp. - ${discount_promo.toLocaleString('id-ID')}`);
                                }

                                selectedTotal -= discount_promo
                            }
                            
                            console.log('discount_promo cart2:',discount_promo)

                            $('.total-cart').empty().html(`Rp. ${selectedTotal.toLocaleString('id-ID')}`);
                        }
                        
                        // Panggil ulang updateTotal setelah memulihkan state checkbox
                        updateTotal();

                        // $('.item-checkbox').click(updateTotal);
                        // Handle checkbox click
                        $('.item-checkbox').click(function() {
                            const isChecked = $(this).is(':checked');
                            const productId = $(this).closest('.list-cart').data('produkid');

                            if (!isChecked && productId === produkIdfromPromo) {
                                unapplyPromo(productId);
                            }

                            updateTotal();
                        });

                        // Select/Deselect all checkboxes
                        let allSelected = false;
                        $('.select-all-button').click(function() {
                            allSelected = !allSelected;
                            $('.item-checkbox').prop('checked', allSelected).each(function(){
                                if (!allSelected) {
                                    isPromoId = undefined;
                                    discount_promo = 0;
                                    
                                    // Update UI
                                    $(`.promo-added-${produkIdfromPromo}`).removeClass("line-through");
                                    $(`.price-promo-${produkIdfromPromo}`).addClass("hidden").empty();
                                    
                                    // Remove promo display from summary
                                    $('.display-promo').empty();
                                    produkIdfromPromo = null;
                                }
                            });
                            updateTotal();
                        });

                        // Add event listeners - only for enabled buttons
                        $('.btn-plus:not([disabled])').click(function() {
                            const itemId = $(this).data('item-id');
                            updateQuantity(itemId, 'increase');
                        });

                        $('.btn-minus:not([disabled])').click(function() {
                            const itemId = $(this).data('item-id');
                            updateQuantity(itemId, 'decrease');
                        });
                    },
                    error: function(xhr) {
                        console.error('Error fetching cart:', xhr.responseText);
                    }
                });
            }

            function updateQuantity(itemId, action) {
                $.ajax({
                    url: '/api/cart/update-quantity',
                    method: 'POST',
                    data: { 
                        item_id: itemId,
                        action: action 
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        // Disable the buttons while processing
                        $('.btn-plus, .btn-minus').prop('disabled', true);
                    },
                    success: function(res) {
                        // Refresh the cart list
                        listCart();
                        
                        // Update cart count in header if you have one
                        updateCartCount();
                    },
                    error: function(xhr) {
                        console.error('Error updating quantity:', xhr.responseText);
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Memperbarui Kuantitas.",
                            text: "Gagal memperbarui kuantitas. Silahkan coba lagi.",
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                    },
                    complete: function() {
                        // Re-enable the buttons
                        $('.btn-plus, .btn-minus').prop('disabled', false);
                    }
                });
            }

            function unapplyPromo(productId) {
                
                isPromoId = undefined;
                produkIdfromPromo = null;
                discount_promo = 0;

                // Update UI
                $(`.promo-added-${productId}`).removeClass("line-through");
                $(`.price-promo-${productId}`).addClass("hidden").empty();

                // Remove promo display from summary
                $('.display-promo').empty();

                let total = 0;
                $('.item-checkbox:checked').each(function() {
                    total += parseInt($(this).data('subtotal'), 10);
                });

                // Recalculate total
                // updateTotal();
                $('.total-cart').empty().html(`Rp. ${total.toLocaleString('id-ID')}`);
            }


            let isPromoAssigned;
            let isPromoId;
            let promoCode;
            

            $('#promoButton').click(function() {
                
                $.ajax({
                    url: '/api/promos',
                    method: 'GET',
                    data: { 
                        id: pelangganId,
                        membership: pelangganMember,
                     },
                    success: function(response) {      

                        // const cancelPromoBtn;
                        console.log(response);
                        $('#display-cancel-promo').empty();
                        $('#promo-details').empty();
                        response.forEach(function(val) {
                        
                            let promoEnds = new Date(val.tanggal_selesai);

                            let promoKindsName;
                            let sometextcolor = val.tipe_promo == 'UMUM' 
                                                ? 'text-pink-keruh'
                                                : 'text-hijau-toska'
                            ;
                            
                            if(val.name == null || val.name == undefined || val.name == "" || val.name == 0){
                                promoKindsName = 'Semua Produk'
                            }else{
                                promoKindsName = val.name;
                            }
                            
                            function formatDate(date) {
                                let day = date.getDate().toString().padStart(2, '0'); // Tambahkan nol di depan jika perlu
                                let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Bulan di JavaScript dimulai dari 0
                                let year = date.getFullYear();
                                return `${day}-${month}-${year}`;
                            }

                            console.log(isPromoId);

                           

                            const promoUsedButton = isPromoId == val.id 
                                                ? `<button class="w-11/12 mx-auto rounded-full bg-kuning-keruh flex justify-center text-lg cursor-not-allowed">TERPAKAI</button>`
                                                : `<button class="w-11/12 mx-auto rounded-full bg-kuning-muda hover:bg-kuning-keruh flex justify-center text-lg set-promo" data-id="${val.id}">PAKAI</button>`

                            const promoListContainer = `
                                <div class="col-span-6 mb-5">
                                    <div class="bg-slate-200 rounded-lg">
                                        <h3 class="text-xl font-bold ${sometextcolor} pt-3 text-center mb-1.5">${val.nama}</h3>
                                        <h3 class="font-bold text-hijau-tua text-center mb-1.5">${promoKindsName}</h3>
                                        <h3 class="mb-3 text-sm font-light flex justify-center">Berakhir pada ${formatDate(promoEnds)}</h3>
                                        <div class="pb-3">
                                            ${promoUsedButton}
                                        </div>  
                                    </div>

                                </div>
                            `;

                            
                            $('#promo-details').append(promoListContainer);
                            
                            const modal = new Modal($('#promoModal')[0]);
                            modal.show();
                            
                            
                        });
                        console.log()
                        const cancelPromoBtn = isPromoId == undefined
                                                ? ``
                                                : `<button class="w-10/12 h-10 rounded-xl bg-gradient-to-r from-coklat-muda to-coklat-tua hover:bg-gradient-to-r hover:from-coklat-tua hover:to-coklat-tua" id="cancel-promo">Batalkan Promo</button>`
                            ;
                        
                        $('#display-cancel-promo').append(cancelPromoBtn);
                        CancelUsingPromo();

                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal mengambil data promo.",
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

            function CancelUsingPromo(){
                $('#cancel-promo').click(function() {
                            
                    isPromoId = undefined;
                    let total = 0;

                    $('.item-checkbox:checked').each(function() {
                       total += parseInt($(this).data('subtotal'), 10);
                    });

                    $('.total-cart').text(`Rp. ${total.toLocaleString('id-ID')}`);

                    $(`.promo-added-${produkIdfromPromo}`).removeClass("line-through");
                    $(`.price-promo-${produkIdfromPromo}`).empty();
                    
                    const modal = new Modal($('#promoModal')[0]);
                    modal.hide();

                    $('.display-promo').empty();
                    showToast("promo berhasil dibatalkan.");
                                
                });
            }

            $('#promo-details').on('click', '.set-promo', function() {
                let promo_id = $(this).data('id');
                setPromo(promo_id);
            });

            function setPromo(id){
                $.ajax({
                    url: '/api/cart/apply-promo',
                    method: 'POST',
                    data: { promo: id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        console.log(response)

                        if(produkIdfromPromo == "" || produkIdfromPromo == null){
                            
                        }else{
                            $(`.promo-added-${produkIdfromPromo}`).removeClass("line-through");
                            $(`.price-promo-${produkIdfromPromo}`).empty();
                        }

                        isPromoId = id;
                        produkIdfromPromo = response.produk_id

                        let discount = response.discount;
                                
                        // successPromoMember = cartProductId.includes(produkIdfromPromo);

                        let total = 0;
                        let haveProduk = false;
                        let deleteStylePromoMember = []
                        // let discountPromoHasProduct = 0;

                        deleteStylePromoMember.push(produkIdfromPromo);
                        
                        $('.item-checkbox:checked').each(function() {
                            total += parseInt($(this).data('subtotal'), 10);
                        });

                        $('.item-checkbox:checked').each(function() {
                            if(produkIdfromPromo == $(this).closest('.list-cart').data('produkid')){
                                
                                $(`.promo-added-${produkIdfromPromo}`).addClass("line-through")
                                $(`.price-promo-${produkIdfromPromo}`).empty();

                                let subtotal = $(`.promo-added-${produkIdfromPromo}`)
                                    .closest('.list-cart') 
                                    .data('subtotal');

                                if(response.discount_type == 'Ammount'){
                                    let totalWithPromo = subtotal - discount
                                    discount_promo = discount
                                    typeDiscountMember = response.discount_type;

                                    $(`.price-promo-${produkIdfromPromo}`).text(`Rp. ${totalWithPromo.toLocaleString('id-ID')}`)
                                    $(`.price-promo-${produkIdfromPromo}`).removeClass("hidden");
                                }else{
                                    let totalPersentage = (subtotal * discount)/100;
                                    percentageProductDiscount = discount;
                                    typeDiscountMember = response.discount_type;
                                    
                                    maximumDiscountMember = response.max_diskon;
                                    if(totalPersentage > response.max_diskon){
                                        totalPersentage = response.max_diskon;
                                    }
                                    discount = totalPersentage;
                                    discount_promo = discount;
                                    let totalWithPromo = subtotal - totalPersentage
                                    
                                    $(`.price-promo-${produkIdfromPromo}`).text(`Rp. ${totalWithPromo.toLocaleString('id-ID')}`)
                                    $(`.price-promo-${produkIdfromPromo}`).removeClass("hidden");
                                }
                                
                                haveProduk = true;
                            }
                        });

                        // console.log(successPromoMember, produkIdfromPromo);

                        promoCode = response.kode_promo;
                        // isPromoAssigned = response.                  
                        $('.display-promo').empty();
                        // console.log('promo',response);
        
                        // const promo_style = response.success ? 
                            // "flex items-center justify-between" : 
                            // "hidden items-center justify-between";
                            
                        let promo_style = ''
                        let access = true
                        let promoProductType;
                        if(produkIdfromPromo == null){
                            if(response.discount_type == 'Ammount'){
                                discount_promo = discount
                                typeDiscountMember = response.discount_type;
                            }else{
                                let totalPersentage = (total * discount)/100
                                percentageProductDiscount = discount;
                                typeDiscountMember = response.discount_type;
                                    
                                maximumDiscountMember = response.max_diskon;
                                if(totalPersentage > response.max_diskon){
                                    totalPersentage = response.max_diskon;
                                }
                                discount = totalPersentage;
                                discount_promo = discount;
                            }
                            promo_style += "flex items-center justify-between" 
                            promoProductType = `Rp. - ${discount.toLocaleString('id-ID')}`;
                        }else if(haveProduk){
                            promo_style += "flex items-center justify-between"
                            promoProductType =` Rp. ${discount.toLocaleString('id-ID')}`;
                        }else{
                            promo_style += "hidden items-center justify-between" 
                            access= false
                        }
                            
                        console.log(discount_promo);
    
                            
                        // let total = parseFloat($('.total-cart').text().replace('Rp. ', '').replace('.', ''));
                            
                            

                        const tampilan_promo = `
                            <div class="mb-5 ${promo_style}">
                                <div>
                                    <span class="text-2xl font-semibold text-hijau">Diskon:</span>
                                    <h3 class="font-normal text-coklat-tua">${response.name}</h3>
                                </div>
                                <h3 class="text-2xl font-semibold text-hijau diskon-cart" >${promoProductType}</h3>
                            </div>
                        `;

                        $('.display-promo').html(tampilan_promo);
                        if(access){
                            const newTotal = total - discount;
                            $('.total-cart').text(`Rp. ${newTotal.toLocaleString('id-ID')}`);      
                        }else{
                            isPromoId = undefined
                            const newTotal = total;
                            $('.total-cart').text(`Rp. ${newTotal.toLocaleString('id-ID')}`); 
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Menggunakan Promo.",
                                text: "Promo hanya dapat diterapkan jika produk terkait sudah dipilih.",
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                        }

                        const modal = new Modal($('#promoModal')[0]);
                        modal.hide();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Menggunakan Promo.",
                            text: xhr.responseJSON.error,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        // alert(xhr.responseJSON.error);
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
                        listCart();
                        updateCartCount(); // Update cart count after successful addition
                        // window.location.reload();
                        showToast('Produk berhasil ditambahkan ke keranjang!');
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

            $(document).on('click', '.delete-cart-item', function() {
                const selectedItems = [];

                // Ambil item yang dipilih dalam cart
                $('.item-checkbox:checked').each(function() {
                    const itemData = $(this).closest('.list-cart').data();
                    console.log(itemData)
                    selectedItems.push(itemData.cartitemid
                    );
                });

                // console.log(selectedItems);
                // return;
                // return
                // Kirim data ke server hanya jika ada item yang dipilih
                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus produk pada keranjang?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal"
                    }).then((result) => {
                    if (result.isConfirmed && selectedItems.length > 0) {
                        $.ajax({
                            url: '/api/cart/remove-multiple-item' ,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                items: selectedItems
                            },
                            success: function(response) {
                                showToast("Barang berhasil dihapus dari keranjang.");
                                listCart();
                                updateCartCount();

                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Produk di keranjang gagal dihapus, silahkan coba lagi.",
                                    text: xhr.responseText,
                                    customClass: {
                                        confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                        cancelButton: "btn btn-danger"
                                    },
                                    buttonsStyling: false
                                });
                            }
                        });
                        Swal.fire({
                            title: "Dihapus!",
                            text: "Produk di Keranjang berhasil dihapus.",
                            icon: "success",
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                    }
                    else if(result.isConfirmed && selectedItems.length == 0){
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Menghapus Produk pada Keranjang.",
                            text: "Pilih Produk yang ingin dihapus pada Keranjang!",
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                    }
                });
                
            });

            // Tambahkan event listener untuk tombol checkout
            $(document).on('click', '#checkout-btn', function() {
                const selectedItems = [];
                // promoCode = $('#promo').val();
                let totalPrice = 0;
                if(isPromoId == "" || isPromoId == undefined || isPromoId == 0){
                    promoCode = undefined;
                    discount_promo = 0;
                }

                // Ambil item yang dipilih dalam cart
                $('.item-checkbox:checked').each(function() {
                    const itemData = $(this).closest('.list-cart').data();
                    console.log(itemData)
                    selectedItems.push({
                        cart_item_id : itemData.cartitemid,
                        produk_id: itemData.produkid,
                        jumlah: itemData.quantity,
                        harga_satuan: itemData.price,
                        subtotal: itemData.subtotal,
                    });
                    totalPrice += itemData.subtotal;
                });

                // console.log(pelangganId,promoCode,totalPrice,selectedItems)
                // return
                // Kirim data ke server hanya jika ada item yang dipilih
                if (selectedItems.length > 0) {
                    $.ajax({
                        url: '/api/cart/checkout',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            pelanggan_id: pelangganId,
                            promo_code: promoCode,
                            promo_discount: discount_promo,
                            notesProduct: notes,
                            total_harga: totalPrice - discount_promo,
                            items: selectedItems
                        },
                        success: function(response) {
                            console.log(response)
                            if(response.is_stock_product_avail){
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil Memesan!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function() {
                                    window.location.href = '/cart/pengiriman/'+response.pemesanan_id;
                                }, 1500);
                            }else{
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal Memesan.",
                                    text: response.message,
                                    customClass: {
                                        confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                        cancelButton: "btn btn-danger"
                                    },
                                    buttonsStyling: false
                                });
                                // alert(response.message);
                            }

                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Memesan, silakan coba lagi!",
                                text: xhr.responseText,
                                customClass: {
                                    confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                    cancelButton: "btn btn-danger"
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal Memesan.",
                        text: "Pilih Produk yang ingin dipesan.",
                        customClass: {
                            confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                            cancelButton: "btn btn-danger"
                        },
                        buttonsStyling: false
                    });
                    // alert('Pilih item yang ingin di-checkout.');
                }
            });

            $('#notesProduct').click(function() {
                    notes = $("#add-notes").val();
                    // console.log(notes);
                    const modal = new Modal($('#notesModal')[0]);
                    modal.hide();
                });

            listCart();
            updateCartCount();


            $('#notesButton').click(function() {
                const modal = new Modal($('#notesModal')[0]);
                modal.show();
            });

            $('[data-modal-hide="promoModal"]').click(function() {
                const modal = new Modal($('#promoModal')[0]);
                modal.hide();
            });
    
            $('[data-modal-hide="notesModal"]').click(function() {
                const modal = new Modal($('#notesModal')[0]);
                modal.hide();
            });

        });
    </script>
    
</html>