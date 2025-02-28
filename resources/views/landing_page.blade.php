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
                <div class="relative mt-32 mb-28">
                    <div class="mt-12 w-10/12 h-128 bg-gradient-to-r from-hijau-keruh to-coklat-muda mx-auto">
                        <img src="{{ asset("img/pempekmenu.jpg") }}" alt="" class="w-full h-full opacity-20">
                    </div>
                    <div class="absolute top-12 left-44">
                        <h1 class="mb-3 text-5xl font-bold">Nikmati Sensasi Kelezatan</h1>
                        <h1 class="mb-3 text-5xl font-bold">Pempek Asli Palembang yang</h1>
                        <h1 class="mb-7 text-5xl font-bold">Menggugah Selera!</h1>
                        <h3 class="text-base">Tidak perlu repot! Pesan sekarang dari rumah, dan kami akan mengantarkan pempek lezat ini</h3>
                        <h3 class="mb-5 text-base">langsung ke depan pintu Anda. Tersedia promo diskon khusus untuk pemesanan pertama!</h3>
                        <div class="w-64 h-17 py-4 bg-gradient-to-r group from-hijau-toska to-pink-keruh rounded-full text-center cursor-pointer hover:bg-gradient-to-b hover:from-pink-keruh hover:to-pink-keruh">
                            <a href="/menu" class="text-white group-hover:text-kuning-keruh font-bold text-2xl">PESAN SEKARANG!</a>
                        </div>
                    </div>
                    <div class="absolute top-12 right-44">
                        <img src="{{ asset("img/1279688542.png") }}" alt="" class="w-100 h-80 object-cover">
                    </div>
                </div>
            </section>

            <section> 
                <div id="gallery" class="relative w-1/2 mx-auto mb-28" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-36 overflow-hidden rounded-lg md:h-40" id="banner-slider">
                        {{-- <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
                        </div>
                        <!-- Item 4 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
                        </div>
                        <!-- Item 5 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
                        </div> --}}
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 -left-16 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-hijau-muda group-hover:bg-hijau-toska group-focus:ring-4 group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 -right-16 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-hijau-muda group-hover:bg-hijau-toska group-focus:ring-4 group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>

                {{-- <div class="relative w-4/5 max-w-4xl mx-auto bg-white shadow-md rounded-md overflow-hidden mb-28">
                    <!-- Image Slider -->
                    <div id="slider" class="relative flex items-center justify-center h-64 bg-gray-200">
                        <img id="sliderImage" class="w-full h-full object-cover" src="" alt="Slider Image">
                    </div>
            
                    <!-- Navigation Buttons -->
                    <button id="prevButton" 
                            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full hover:bg-gray-700">
                        &lt;
                    </button>
                    <button id="nextButton" 
                            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full hover:bg-gray-700">
                        &gt;
                    </button>
                </div> --}}
                
            </section>

            <section class="max-w-full bg-gradient-to-b from-putih to-hijau-keruh">
                <div class="w-1/2 mx-auto mb-12">
                    <h1 class="text-center text-hijau-tua font-extrabold text-5xl mb-7">Menu</h1>
                    <img src="{{ asset("img/Line 1.png") }}" alt="" class="h-auto mx-auto mb-7">
                    <h3 class="text-center text-hijau-tua font-semibold text-2xl mb-4">Kami menawarkan dua pilihan pempek sesuai selera Anda</h3>
                    <h4 class="text-center text-hijau-tua text-xl mb-7">Pilih sesuai kebutuhan Anda, dan nikmati kelezatan Pempek asli Palembang di rumah!</h4>
                </div>

                
                <div class="w-11/12 mx-auto mb-19 relative">
                    <div class="border-[7px] border-solid border-hijau-tua"></div>
                    <div class="flex group">
                        <a href="/menu" class="absolute top-7 right-7 text-hijau-tua font-semibold group-hover:underline mr-7">Lihat Semua </a>
                        <a href="/menu" class="absolute top-7 right-7 text-hijau-tua font-semibold">--></a>
                    </div>
                    <div class="w-full mt-12 relative">
                        <div class="container grid grid-cols-5 gap-7" id="list-product">
                        </div>
                    </div>
                </div>

                <section>
                <div class="relative mt-32">
                    <div class="max-w-full h-150 overflow-hidden bg-hijau-tua">
                        <img src="{{ asset("img/pempekmenu.jpg") }}" alt="" class="w-full opacity-20 object-cover">
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
                
            <section>
                <div class="mt-20">
                    <h1 class="text-hijau-tua text-5xl font-bold mb-7 text-center">Pertanyaan yang Sering Diajukan</h1>
                    <div class="border-[8px] border-solid border-hijau-tua w-1/2 mx-auto mb-10"></div>
                    <div class="w-2/3 mx-auto">
                        <h3 class="text-center text-hijau-tua font-semibold text-2xl mb-20">Di bawah ini merupakan pertanyaan-pertanyaan yang sering ditanyakan banyak orang tentang website Pempek Cmay.</h3>
                    </div>
                    <div class="w-10/12 mx-auto flex justify-between space-x-7">
                        <div class="w-1/2">
                            <span class="text-center text-hijau-tua font-semibold text-xl">Apakah pempek frozen bisa langsung digoreng atau harus diolah terlebih dahulu?</span>
                            <p class="text-gray-600 text-lg mt-2">Pempek frozen kami bisa langsung digoreng atau dikukus tanpa perlu diolah lagi, sesuai dengan keinginan Anda.</p>
                        </div>
                        <div class="w-1/2">
                            <span class="text-center text-hijau-tua font-semibold text-xl">Berapa lama waktu pengiriman untuk pempek frozen dan cepat saji?</span>
                            <p class="text-gray-600 text-lg mt-2">Pengiriman dilakukan berdasarkan lokasi serta jenis pempek yang dipesan. Untuk area Jakarta, kami menyediakan pengiriman di hari yang sama untuk semua jenis pempek, sedangkan untuk area di luar Jakarta, pengiriman dilakukan dalam 1-3 hari kerja tergantung lokasi Anda untuk pempek jenis frozen</p>
                        </div>
                    </div>
                    <div class="w-10/12 mx-auto flex justify-between space-x-7 mt-10">
                        <div class="w-1/2">
                            <span class="text-center text-hijau-tua font-semibold text-xl">Apa benefit yang didapatkan dengan menjadi member?</span>
                            <p class="text-gray-600 text-lg mt-2">Dengan menjadi member di website ini, anda akan mendapatkan promo eksklusif berupa diskon khusus untuk produk tertentu tiap bulannya.</p>
                        </div>
                        <div class="w-1/2">
                            <span class="text-center text-hijau-tua font-semibold text-xl">Bagaimana cara mengaktifkan member?</span>
                            <p class="text-gray-600 text-lg mt-2">Anda cukup membuat akun di website kami dan memenuhi syarat dengan melakukan transaksi sebanyak 5x untuk mengaktifkan keanggotaan Anda.</p>
                        </div>
                    </div>
                    <div class="w-10/12 mx-auto flex justify-between space-x-7 mt-10">
                        <div class="w-1/2">
                            <span class="text-center text-hijau-tua font-semibold text-xl">Apa saja metode pembayaran yang tersedia?</span>
                            <p class="text-gray-600 text-lg mt-2">Kami hanya menyediakan metode pembayaran transfer bank BCA.</p>
                        </div>
                        <div class="w-1/2">
                            <span class="text-center text-hijau-tua font-semibold text-xl">Bagaimana cara saya melacak pesanan saya?</span>
                            <p class="text-gray-600 text-lg mt-2">Anda bisa melacak pesanan melalui halaman order history akun anda pada detail pesanan yang akan menampilkan nomor resi pengiriman untuk pengiriman luar jakarta.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-32">
                    <h1 class="text-black text-5xl font-bold mb-7 text-center">Hubungi Kami</h1>
                    <img src="{{ asset("img/Line_black.png") }}" alt="" class="mx-auto mb-10">
                    <div class="w-2/3 mx-auto">
                        <h3 class="text-center text-hijau-tua font-semibold text-2xl mb-10">Untuk informasi lebih lanjut, anda dapat menghubungi kami dengan mengisi formulir
                            atau menggunakan informasi kontak kami di bawah ini.
                        </h3>
                    </div>
                </div>
                <div class="w-1/2 bg-gradient-to-b from-hijau-tua to-hijau-keruh mx-auto rounded-xl overflow-auto mb-10">
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
                </div>
            </section>

            <div id="banner-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Promo
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="banner-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                            <div class="space-y-2" id="information-modal">
                            </div>
                            {{-- <img src="{{ asset("banner_promo/1733819233-pempekmenu.jpg") }}" alt="banner" class="w-full h-36">
                            <h3 class="text-gray-800 text-2xl font-bold">Promo Tahun baru</h3>
                            <h3 class="text-gray-800 font-semibold">MEMBER</h3>
                            <h3 class="text-gray-800">Potongan harga Rp. 10.000 untuk semua produk</h3>
                            <h3 class="text-gray-800">Diskon sebesar 30% maksimum Rp. 10.000 untuk semua produk</h3>
                            <h3 class="text-gray-800 mt-3">Mari kita hormati hari dimana makanan nikmat tekwan tercipta.</h3> --}}
                        </div>
                    </div>
                </div>
            </div>

            <x-footer></x-footer>


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
            function loadProducts() {
                $.ajax({
                    url: '/api/products',
                    method: 'GET',
                    data :{
                        paginate : 5,
                        menu:'landing',
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
                                            <button class="text-hijau-tua font-semibold" data-product-id="${product.id}" data-product-price="${product.price}">Tambah Ke keranjang</button>
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

            function attachEventListeners() {
                
                $('.banner-promo-link').click(function(e) {
                    e.preventDefault();
                    var promoId = $(this).data('id');
                    console.log(promoId)
                    
                    $.ajax({
                        url: `/api/promos/${promoId}`,
                        method: 'GET',
                        success: function(response) {
                            console.log(response,promoId)
                            let detailPromo = $('#information-modal');
                            detailPromo.empty();

                            let promoEnds = new Date(response.tanggal_selesai);

                            function formatDate(date) {
                                let day = date.getDate().toString().padStart(2, '0'); // Tambahkan nol di depan jika perlu
                                let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Bulan di JavaScript dimulai dari 0
                                let year = date.getFullYear();
                                return `${day}-${month}-${year}`;
                            }

                            const productPromo = response.name
                                                ? `${response.name}`
                                                : `Semua Produk`
                            ;

                            const typePromo = response.tipe_promo == "MEMBER" 
                                            ? `<h3 class="text-hijau-tua font-semibold">Promo Khusus ${response.tipe_promo}</h3>`
                                            : `<h3 class="text-pink-keruh font-semibold">Promo ${response.tipe_promo}</h3>`
                            ;

                            const typeDiscount = response.tipe_diskon == "Ammount"
                                                ? `Potongan harga Rp. ${response.diskon.toLocaleString('id-ID')} untuk ${productPromo}`
                                                : `Diskon sebesar ${response.diskon}% maksimum Rp. ${response.max_diskon.toLocaleString('id-ID')} untuk produk ${[productPromo]}`
                            ;

                            let detailHtml = `
                                    <img src="${baseUrl}/banner_promo/${response.banner_promo}" alt="${response.nama}" class="w-full h-36">
                                    <h3 class="text-gray-800 text-2xl font-bold">${response.nama}</h3>
                                    ${typePromo}
                                    <h3 class="mb-5 text-sm font-light">Berakhir pada ${formatDate(promoEnds)}</h3>
                                    <h3 class="text-gray-800 font-semibold mb-5">${typeDiscount}</h3>
                                    <h3 class="text-gray-800">${response.deskripsi}</h3>   
                            `;

                            detailPromo.append(detailHtml);

                            const modal = new Modal($('#banner-modal')[0]);
                            modal.show();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Mengambil Data Promo.",
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

            function initSlider() {
                const gallery = document.querySelector('#gallery');
                // console.log(gallery)
                if (gallery) {
                    // Inisialisasi slider (Flowbite atau library lain)
                    new Carousel(gallery, {
                        interval: 5000, // Interval otomatis
                        pauseOnHover: true, // Pause saat hover
                    });
                }
            }

            function LoadPromos(){
                
                $.ajax({
                    url: '/api/promos',
                    method: 'GET',
                    success: function(response) {
                        
                        let bannerSlider = $('#banner-slider');
                        if (response.length > 0) {
                            bannerSlider.empty(); // Hapus hanya jika ada data baru
                        }
                        // Lanjutkan logika pembuatan elemen slider
                        let count = 0;
                        
                        console.log(response, count);
                        let bannerPromoHtml;
                        $("#gallery").removeClass("hidden");


                        if(response.length == 0){
                            $("#gallery").addClass("hidden");
                            return;
                        }

                        response.forEach(function(promo){
                            console.log(count, promo)
                            
                            bannerPromoHtml = `
                                    <a href="#" class="hidden duration-700 ease-in-out banner-promo-link" data-carousel-item="${count === 0 ? 'active' : ''}" data-id="${promo.id}" data-position="${count}">                   
                                        <img src="${baseUrl}/banner_promo/${promo.banner_promo}" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="${promo.nama}">
                                    </a>
                            `;
    
                            bannerSlider.append(bannerPromoHtml)
                            count++;
                            
                        });
                        
                        // console.log('testing')
                        // new Flowbite.Carousel(document.getElementById('banner-slider'), {
                        //     interval: 5000,
                        //     indicators: true,
                        // });
                        // initSlider();
                        attachEventListeners();
                        initFlowbite();

                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Data Promo.",
                            text: xhr.responseText,
                            customClass: {
                                confirmButton: "bg-hijau-toska px-4 py-2 text-white rounded-lg hover:bg-hijau-tua",
                                cancelButton: "btn btn-danger"
                            },
                            buttonsStyling: false
                        });
                        console.error('Error loading promos:', xhr.responseText);
                    }
                });
            }

            LoadPromos();
            
            
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
                    }
                });
            });

            loadProducts();
            updateCartCount();

            // Update cart count after adding an item//ammar
            $(document).on('click', '.add-to-cart', function() {
                let button = $(this).find('button');
                let productId = button.data('product-id');
                let productPrice = button.data('product-price');
                
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

            $('[data-modal-hide="banner-modal"]').click(function() {
                const modal = new Modal($('#banner-modal')[0]);
                modal.hide();
            });

        });

    </script>
    
</html>