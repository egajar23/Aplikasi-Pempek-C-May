@extends('admin.layouts.app')

@section('content')

<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-2 md:mb-0">Promo</h2>
        <button id="addPromoButton" class="bg-hijau-toska text-white px-4 py-2 rounded">Tambah</button>
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500 bg-white" id="promo-table">
            <thead class="text-xs text-gray-700 uppercase bg-abu-abu">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Promo</th>
                    <th scope="col" class="px-6 py-3">Jenis Promo</th>
                    <th scope="col" class="px-6 py-3">Tipe Promo</th>
                    <th scope="col" class="px-6 py-3 w-[20%]">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 w-[15%]">Diskon</th>
                    <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                    <th scope="col" class="px-6 py-3">Tanggal Selesai</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody id="promoTableBody">
                {{-- Data Promo akan dimuat di sini --}}
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Tambah/Edit Promo -->
<div id="promo-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-lg">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                    Ubah Promo
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="promo-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 pt-0">
                <form id="promoForm" class="" action="#" method="POST">
                    @csrf
                    <div class="max-h-[450px] overflow-y-auto pb-3 pr-3 space-y-4">
                        <input type="hidden" id="promo-id">
                        <div>
                            <label for="promo-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Promo</label>
                            <input type="text" name="nama" id="promo-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        </div>
                        <div>
                            <label for="promo-code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Promo</label>
                            <input type="text" name="kode_promo" id="promo-code" placeholder="Contoh: NEWYEAR2024" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        </div>
                        <div class="relative group">
                            <label for="promo-kind" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Promo</label>
                            <select id="promo-kind" name="produk_id" class="js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">Semua Produk</option>
                            </select>
                            <span class="absolute right-5 top-1 text-sm text-red-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100">Pilih Produk yang ingin diberikan diskon.</span>                 
                        </div>
                        <div class="relative group">
                            <label for="promo-type-discount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Diskon</label>
                            <select id="promo-type-discount" name="tipe_diskon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="Ammount">Ammount</option>
                                <option value="Persentase">Persentase</option>
                            </select>
                            <span class="absolute right-0 top-1 text-sm text-red-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100">Pilih diskon nominal harga (ammount) / persentase %.</span>                       
                        </div>
                        <div>
                            <label for="promo-deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea name="deskripsi" id="promo-deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"></textarea>
                        </div>
                        <div>
                            <label for="promo-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Promo</label>
                            <select id="promo-type" name="tipe_promo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="UMUM">Umum</option>
                                <option value="MEMBER">Member</option>
                            </select>                        
                        </div>
                        <div class="relative group">
                            <label for="promo-diskon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diskon</label>
                            <input type="number" name="diskon" id="promo-diskon" placeholder="'Ammount' = 10000 , 'Persentase' = 30" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                            <span class="text-red-600 text-sm hidden transition duration-300 group-hover:flex">Untuk tipe "ammount" masukkan nominal harga untuk diskon.</span>
                            <span class="text-red-600 text-sm hidden transition duration-300 group-hover:flex">Untuk tipe "Persentase" masukkan angka persentase diskon dimana maksimum persentase 100.</span>
                        </div>
                        <div class="relative group">
                            <label for="max-diskon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maksimum Diskon</label>
                            <input type="number" name="max_diskon" id="max-diskon" placeholder="'Ammount' = 0 , 'Persentase' = 12000" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                            <span class="text-red-600 text-sm hidden transition duration-300 group-hover:flex">Untuk "ammount" masukkan angka 0 untuk max diskon</span>
                            <span class="text-red-600 text-sm hidden transition duration-300 group-hover:flex">Untuk "Persentase" masukkan maksimum diskon yang diberikan.</span>
                        </div>
                        <div>
                            <label for="promo-tanggal-mulai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="promo-tanggal-mulai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        </div>
                        <div>
                            <label for="promo-tanggal-selesai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="promo-tanggal-selesai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required />
                        </div>
                        <div>
                            <label for="banner_promo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Banner Promo</label>
                            <input type="file" name="banner_promo" id="banner_promo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" />
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="image-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-screen bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="image-modal-title">
                    Banner Promo
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center close-image-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="image-container">
                    <!-- Images will be inserted here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Inisialisasi modal menggunakan Flowbite
        const modalElement = document.getElementById('promo-modal');
        const modalOptions = {}; // bisa tambahkan opsi tambahan jika diperlukan
        const modal = new Modal(modalElement, modalOptions);
        const baseUrl = "{{ url('/') }}";
        let count = 1;

        function loadProducts(){
            $.ajax({
                url: '/api/products',
                method: 'GET',
                success: function(response) {

                    var promoProduct = $('#promo-kind');

                    // console.log(response)

                    response.forEach(function(val) {

                        var optionPromoVal = `
                            <option value="${val.id}">${val.name}</option>
                        `;
                        promoProduct.append(optionPromoVal);
                    });

                    $('.js-example-basic-single').select2({
                        width: "100%" // need to override the changed default
                    });

                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal mengambil produk id.",
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

        // Load data promo dari API
        function loadPromos() {
            $('#promo-table').DataTable().destroy();

            $.ajax({
                url: '/api/promos',
                method: 'GET',
                success: function(response) {
                    var tableBody = $('#promoTableBody');
                    tableBody.empty();

                    response.forEach(function(val) {
                        const typeColorBtn = val.tipe_promo =="MEMBER" 
                                        ? 'text-hijau-toska'
                                        : 'text-blue-400';

                        console.log(val, val.produk_id)
                        const kindPromoVal = val.produk_id == 0 || val.produk_id == null 
                                        ? 'Semua Produk'
                                        : val.name;

                        const typeDiscountVal = val.tipe_diskon == 'Ammount' 
                                        ? `${'Rp. ' + val.diskon.toLocaleString()}`
                                        : `${val.diskon + '% max Rp. ' + val.max_diskon.toLocaleString()}` 
                        
                        const typeDiscountPromo = val.tipe_diskon == 'Ammount' 
                                        ? 'Nominal Harga '
                                        : `${val.tipe_diskon + ' % '}`

                        var row = `
                            <tr class="border-b">
                                <td class="px-6 py-4">${val.nama}</td>
                                <td class="px-6 py-4">${kindPromoVal}</td>
                                <td class="px-6 py-4">${typeDiscountPromo}<span class="${typeColorBtn} font-semibold">(${val.tipe_promo})</span></td>
                                <td class="px-6 py-4 w-32">${val.deskripsi || '-'}</td>
                                <td class="px-6 py-4">${typeDiscountVal}</td>
                                <td class="px-6 py-4">${val.tanggal_mulai}</td>
                                <td class="px-6 py-4">${val.tanggal_selesai}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="#" class="w-7 h-7 mt-2 bg-hijau-toska hover:bg-hijau-tua rounded" data-id="${val.id}"><img src="${baseUrl}/img/photos-icon.png" class="p-1" alt="show-img-icon"></a>
                                    <a href="#" class="w-7 h-7 mt-2 bg-blue-600 hover:bg-blue-800 rounded edit-promo-btn" data-id="${val.id}"><img src="${baseUrl}/img/edit.png" class="p-1" alt="edit-icon"></a>
                                    <a href="#" class="w-7 h-7 mt-2 bg-red-600 hover:bg-pink-keruh rounded delete-promo-btn" data-id="${val.id}"><img src="${baseUrl}/img/22706719.png" class="py-1" alt="delete-icon"></a>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });

                    $('#promo-table').DataTable({
                        scrollY: true,
                        searching: true, // Aktifkan pencarian
                        columns: [
                            { searchable: true, width: "15%"},  // Nama Promo
                            { searchable: true, orderable: false, width: "13%"}, // Jenis Promo
                            { searchable: true, width: "10%"},  // Tipe Promo
                            { searchable: false, orderable: false, width: "20%"}, // Deskripsi
                            { searchable: false, orderable: false, width: "10%" },  // Diskon
                            { searchable: false, width: "10%" }, // Tanggal Mulai
                            { searchable: false, width: "10%" }, // Tanggal Selesai
                            { searchable: false, orderable: false, width: "12%"}  // Aksi
                        ],
                        language: {
                            search: "Cari:",
                            lengthMenu: "_MENU_ data per halaman",
                            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                            infoEmpty: "Tidak ada data yang tersedia",
                            infoFiltered: "(disaring dari _MAX_ total data)",
                            zeroRecords: "Tidak ditemukan data yang sesuai",
                        },
                    });

                        $(`#dt-length-${count}`).addClass("w-[65px]");
                        count++;

                    attachEventListeners();
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
        }

        // Initial load
        loadPromos();

        

        // Event listeners
        function attachEventListeners() {
            // Edit Promo
            $('#promo-table').on('click', '.edit-promo-btn', function(e) {
                e.preventDefault();
                
                var promoId = $(this).data('id');
                
                $.ajax({
                    url: `/api/promos/${promoId}`,
                    method: 'GET',
                    success: function(response) {
                        $('#promo-id').val(response.id);
                        $('#promo-name').val(response.nama);
                        $('#promo-code').val(response.kode_promo);
                        $('#promo-kind').val(response.produk_id);
                        $('#promo-type-discount').val(response.tipe_diskon);
                        $('#promo-deskripsi').val(response.deskripsi);
                        $('#promo-type').val(response.tipe_promo);
                        $('#max-diskon').val(response.max_diskon);
                        $('#promo-diskon').val(response.diskon);
                        $('#promo-tanggal-mulai').val(response.tanggal_mulai);
                        $('#promo-tanggal-selesai').val(response.tanggal_selesai);

                        $('#modal-title').text('Edit Promo');

                        modal.show(); // Menampilkan modal
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal memperbarui promo.",
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

            // Hapus Promo
            $('#promo-table').on('click', '.delete-promo-btn', function(e) {
                e.preventDefault();

                var promoId = $(this).data('id');

                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus promo ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/api/promos/delete/${promoId}`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                loadPromos();
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal menghapus promo.",
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
                            text: "Promo berhasil dihapus.",
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
        }

        // Form submit untuk tambah/edit promo
        $('#promoForm').submit(function(e) {
            e.preventDefault();

            var promoId = $('#promo-id').val();
            var formData = new FormData(this);

            // var method = promoId ? 'PUT' : 'POST';
            var url = promoId ? `/api/promos/${promoId}` : '/api/promos';
            if(promoId){

                formData.append('_method', 'PUT');
            }
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false, 
                success: function() {
                    showToast('Promo berhasil disimpan.');
                    modal.hide(); // Menyembunyikan modal
                    loadPromos();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal menyimpan promo.",
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

        // Event untuk tombol tambah promo
        $('#addPromoButton').click(function() {
            $('#promo-id').val('');
            $('#promoForm')[0].reset();
            $('#modal-title').text('Tambah Promo');
            modal.show(); // Menampilkan modal
        });
        $('[data-modal-hide="promo-modal"]').click(function() {
            modal.hide(); // Menyembunyikan modal
        });

        function showImageModal(promoId) {
            // Show loading state
            $('#image-container').html('<div class="col-span-3 text-center py-4">Loading...</div>');
            $('#image-modal').removeClass('hidden').addClass('flex');
            
            // Fetch product images
            $.ajax({
                url: `/api/promos/${promoId}`,
                method: 'GET',
                success: function(promo) {
                    console.log(promo)
                    var container = $('#image-container');
                    container.empty();
                    
                    if (promo.banner_promo && promo.banner_promo.length > 0) {
                        console.log(promo.banner_promo)
                        var imgDiv = $('<div>')
                            .addClass('relative aspect-square')
                            .append(    
                                $('<img>')
                                    .attr('src', `${baseUrl}/banner_promo/${promo.banner_promo}`)
                                    .attr('alt', 'Promo Banner')
                                    .addClass('h-full w-full rounded-lg object-cover item-center')
                                    .on('error', function() {
                                        $(this)
                                            .attr('src', '//placeholder/400/400')
                                            .off('error');
                                    })
                            );
                        container.append(imgDiv);
                        
                    } else {
                        container.html('<div class="col-span-3 text-center py-4">Tidak ada gambar tersedia.</div>');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    $('#image-container').html(
                        '<div class="col-span-3 text-center py-4 text-red-600">Gagal memuat gambar.</div>'
                    );
                }
            });
        }

        // Close image modal
        function closeImageModal() {
            $('#image-modal').addClass('hidden').removeClass('flex');
        }

        $(document).on('click', 'a[data-id]:not(.edit-promo-btn):not(.delete-promo-btn)', function(e) {
            e.preventDefault();
            var promoId = $(this).data('id');
            showImageModal(promoId);
        });

        // Close modal when clicking close button
        $(document).on('click', '.close-image-modal', function() {
            closeImageModal();
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && !$('#image-modal').hasClass('hidden')) {
                closeImageModal();
            }
        });

    });
</script>

@endsection
