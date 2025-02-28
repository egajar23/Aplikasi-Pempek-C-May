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
                <div class="w-10/12 mt-52 mb-10 mx-auto">
                    <div class="grid grid-cols-9">
                        <div class="col-span-3 relative" id="image-slider">
                            <div class="flex items-center justify-center" id="imageProduct"></div>
                    
                            <!-- Navigation Indicators -->
                            <div class="flex justify-center mt-4 space-x-2" id="indicators"></div>
                        </div>
                        <div class="row-span-3 col-span-6 items-center">
                            <h3 class="text-pink-keruh text-4xl font-bold mb-1">{{ $product['name'] }}</h3>
                            <h3 class="text-gray-900 text-xl font-light">Stok: {{ $product['stock'] }}</h3>
                            <h3 class="text-gray-900 text-3xl font-semibold mt-5">{{ "Rp. " . number_format($product['price'], 0, ',', '.') }}</h3>
                            <div class="border-[3px] border-solid border-abu-abu mt-5"></div>
                            <div class="flex mt-16">
                                <h3 class="text-black text-3xl font-light">Jumlah:</h3>
                                <div class="flex items-center justify-between ml-12 w-40 h-14 bg-abu-abu border-[3.5px] border-solid border-black rounded-full shadow-[0_4px_18px_rgba(0,0,0,0.25)]">
                                    <button class="decrease-qty pl-4 pb-2 text-4xl">-</button>
                                    <h3 class="display-qty font-bold text-xl">1</h3>
                                    <button class="increase-qty pr-4 pb-2 text-4xl">+</button>
                                </div>
                                <div class="add-to-cart w-72 h-14 py-3.5 ml-12 bg-gradient-to-b from-kuning-muda to-kuning-keruh rounded-full text-center hover:bg-gradient-to-b hover:from-kuning-keruh hover:to-kuning-keruh">
                                    <button class="text-hijau-tua font-semibold text-xl" data-product-id="{{ $product['id'] }}" data-product-price="{{ $product['price'] }}">Tambah ke Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <div class="w-10/12 mx-auto border-[3px] border-solid border-abu-abu mt-5"></div> 
                <section>
                    <div class="w-10/12 mt-10 mx-auto">
                        <h3 class="mb-5 text-3xl font-semibold">Deskripsi</h3>
                        <p class="mb-10 text-2xl">{{ $product['description'] }}</p>
                        <div class="w-full mx-auto border-[3px] border-solid border-abu-abu mt-5"></div> 
                    </div>
                    <div class="w-10/12 mt-10 mx-auto">
                        <div class="flex mb-12">
                            <h3 class="text-3xl font-semibold">Ulasan</h3>
                            <div class="flex mt-0.5 ml-5 space-x-3">
                                <img src="{{ asset("img/pngegg (3).png") }}" alt="" class="w-8 h-8" id="starImage">
                                <span class="text-xl pt-1" id="meanScore"> 5.0 dari 32 ulasan</span>
                            </div>
                        </div>
                        <div class="h-12 overflow-auto" id="showReview">
                            
                        </div>
                        <div class="w-full mx-auto border-[3px] border-solid border-abu-abu mt-10"></div> 
                    </div>
                </section>

                <section>
                    <div class="w-11/12 mx-auto">
                        <h3 class="mt-20 font-bold text-3xl mb-10">PRODUK TERKAIT</h3>
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
            let ratingScore;
            let totalReview = 0;
            let finalReview = 0;
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
                                        <div class="add-to-cart-list cursor-pointer w-48 h-12 py-2.5 mx-auto bg-gradient-to-b from-white to-kuning-keruh rounded-full text-center hover:bg-gradient-to-b hover:from-kuning-keruh hover:to-kuning-keruh">
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
                    }
                });
            }

            function loadIMGProducts() {
                let slug = "{{ $product['slug'] }}";
                $.ajax({
                    url: '/api/products/get-by-slug/' + slug,
                    method: 'GET',
                    data: {
                        slug: slug,
                    },
                    success: function(response) {
                        let productContainer = $('#imageProduct');
                        productContainer.empty(); // Kosongkan kontainer gambar
                        let indicatorsContainer = $('#indicators');
                        indicatorsContainer.empty(); // Kosongkan kontainer indikator
                        let count = response[0].images.length; // Jumlah gambar
                        let product = response[0];
                        
                        response[0].images.forEach((image, index) => {
                            // Tambahkan gambar ke kontainer
                            let productHtml = `
                                <img src="${baseUrl}/product/${image.image_path}" alt="${product.name}" class="w-64 h-64 slider-image ${index === 0 ? '' : 'hidden'}">   
                            `;
                            productContainer.append(productHtml);

                            // Tambahkan indikator
                            let indicatorHtml = `
                                <button class="indicator w-4 h-4 bg-gray-400 rounded-full ${index === 0 ? 'bg-coklat-muda' : ''}"></button>
                            `;
                            indicatorsContainer.append(indicatorHtml);
                        });

                        // Perbarui logika slider setelah gambar dimuat
                        let currentIndex = 0;
                        const images = $('#imageProduct .slider-image');
                        const indicators = $('#indicators .indicator');

                        function showImage(index) {
                            images.addClass('hidden');
                            $(images[index]).removeClass('hidden');
                            indicators.removeClass('bg-coklat-muda').addClass('bg-gray-400');
                            $(indicators[index]).removeClass('bg-gray-400').addClass('bg-coklat-muda');
                        }

                        indicators.click(function() {
                            currentIndex = $(this).index();
                            showImage(currentIndex);
                        });

                        showImage(currentIndex); // Tampilkan gambar pertama setelah dimuat
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

            function showReview(){
                let product_id = "{{ $product['id'] }}";
                $.ajax({
                        url: '/api/show-reviews',
                        method: 'GET',
                        data: { product_id: product_id },
                        success: function(response) {
                            // $('#count-cart').text(response.count);
                            var productHtml = "";
                            let reviewContainer = $('#showReview');
                            reviewContainer.empty();
                            reviewContainer.removeClass("h-12").addClass("h-40");
                            
                            if (response.length === 0) {
                                // Jika tidak ada data
                                reviewContainer.removeClass("h-40").addClass("h-12");
                                let rateProduct = $('#meanScore').empty();
                                // let imgStar = $('#starImage').addClass('hidden');

                                reviewContainer.append(`
                                    <div class="w-full mx-auto">
                                        <h3 class="text-2xl text-center">Tidak Ada Review</h3>
                                    </div>
                                `)
                                return;
                            }
                            
                            response.forEach(function(review) {
                                let bintang = review.bintang;
                                console.log(review.bintang)
                                let htmlBintang='';
                                for(let i = 0; i < bintang;i++){
                                    htmlBintang += `<img src="{{ asset("img/pngegg (3).png") }}" alt="" class="w-7 h-7 mt-2">` 
                                }

                                let defaultProfileIMG = review.pelanggan.profile_picture 
                                                        ? `<img src="${baseUrl}/profile_picture/${review.pelanggan.profile_picture}" alt="${review.pelanggan.name}" class="w-12 h-12 rounded-full mr-3">`
                                                        : `<img src="${baseUrl}/img/profile.png" alt="${review.pelanggan.name}" class="w-12 h-12 rounded-full mr-3">`
                                function formatDate(isoDate) {
                                    const date = new Date(isoDate); // Konversi ISO date ke objek Date
                                    const day = String(date.getDate()).padStart(2, '0'); // Ambil hari (dd)
                                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Ambil bulan (mm)
                                    const year = date.getFullYear(); // Ambil tahun (yyyy)

                                    return `${day}-${month}-${year}`; // Gabungkan menjadi format dd-mm-yyyy
                                }

                                // console.log(review.created_at)
                                productHtml += `
                                <div>
                                    <div class="flex justify-between mb-5">
                                        <div class="flex">
                                            ${defaultProfileIMG}
                                            <h3 class="text-2xl text-hijau-toska mr-4 pt-1.5">${review.pelanggan.name}</h3>
                                            ${htmlBintang}
                                        </div>
                                        <h3 class="text-lg font-light pt-1.5 mr-4">${formatDate(review.created_at)}</h3>
                                    </div>
                                    <p class="mb-12 text-2xl">${review.ulasan}</p>
                                </div>
                                        `;
                                        totalReview += bintang;
                                        finalReview = totalReview/response.length
                                        $('#meanScore').text(parseFloat(finalReview.toFixed(2)) +' dari ' + response.length + ' ulasan');
                                    })
                                    reviewContainer.append(productHtml);
                                    
                                },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Mengambil Data Ulasan.",
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

            showReview();

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

            
            let qty = 1;
            let stock = "{{ $product['stock'] }}";
            let cartQty = 0;

            function updateQuantity(){
                $('.display-qty').text(qty);
            }

            $('.decrease-qty').click(function(){
                if(qty > 1){
                    qty-= 1;
                    updateQuantity();
                }
            })

            $('.increase-qty').click(function(){
                if(qty < stock){
                    qty+= 1;
                    updateQuantity();
                }
            })
           

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
                        quantity: qty,
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

            $(document).on('click', '.add-to-cart-list', function() {
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

            loadProducts();
            loadIMGProducts();
            updateCartCount();
        });
    </script>

    <script>
        $(document).ready(function() {
            
            let currentIndex = 0;
            const images = $('#imageProduct .slider-image');
            const indicators = $('#indicators .indicator');
            const totalImages = images.length;
        
            function showImage(index) {
                images.addClass('hidden'); // Sembunyikan semua gambar
                $(images[index]).removeClass('hidden'); // Tampilkan gambar yang dipilih

                // $(images[index]).show();
                indicators.removeClass('bg-blue-500').addClass('bg-gray-400');
                $(indicators[index]).removeClass('bg-gray-400').addClass('bg-blue-500');
            }
        
            indicators.click(function() {
                currentIndex = $(this).index();
                console.log('currentIndex',currentIndex)
                showImage(currentIndex);
            });
        
            showImage(currentIndex); // Show the first image initially
        });
    </script>
</html>