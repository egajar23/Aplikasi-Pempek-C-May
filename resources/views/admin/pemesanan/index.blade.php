@extends('admin.layouts.app')

@section('content')
<div id="toast-success" class="hidden fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800" role="alert">
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

<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-2 md:mb-0">Pemesanan</h2>
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500 bg-white" id="order-table">
            <thead class="text-xs text-gray-700 bg-abu-abu">
                <tr>
                    <th scope="col" class="px-6 py-3 uppercase">Pelanggan</th>
                    <th scope="col" class="px-6 py-3 uppercase">Tanggal Pesanan</th>
                    <th scope="col" class="px-6 py-3">DISKON PROMO (Rp.)</th>
                    <th scope="col" class="px-6 py-3 uppercase">Status</th>
                    <th scope="col" class="px-6 py-3">TOTAL HARGA (Rp.)</th>
                    <th scope="col" class="px-6 py-3 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {
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

        const baseUrl = "{{ url('/') }}";
        let count = 1;

        function loadOrders() {
            var tableBody = $('#tableBody');
            $('#order-table').DataTable().destroy();

            // Show loading indicator
            tableBody.html('<tr><td colspan="7" class="text-center py-4">Loading...</td></tr>');
            
            $.ajax({
                url: '/api/pemesanans',
                method: 'GET',
                success: function(response) {
                    tableBody.empty();
                    
                    if (response.length === 0) {
                        tableBody.html('<tr><td colspan="7" class="text-center py-4">Tidak ada produk tersedia.</td></tr>');
                    } else {
                        response.forEach(function(val) {
                            
                            var row = `
                                <tr class="border-b">
                                    <td class="px-6 py-4">${val.user.name}</td>
                                    <td class="px-6 py-4">${moment(val.tanggal_pemesanan).format("D MMMM YYYY")}</td>
                                    <td class="px-6 py-4">${val.promo_discount ? val.promo_discount.toLocaleString("id-ID") : '-'}</td>
                                    <td class="px-6 py-4">${val.status}</td>
                                    <td class="px-6 py-4">${val.total_harga.toLocaleString("id-ID")}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        ${val.status == 'Dibayar'? `<a href="/admin/pemesanan/${val.id}" 
                                            class="bg-hijau-toska w-20 p-1 text-center font-medium text-putih rounded hover:bg-hijau-tua confirm-btn" 
                                            data-id="${val.id}">
                                                Konfirmasi
                                            </a>`:`<a href="/admin/pemesanan/${val.id}" 
                                            class="w-7 h-7 bg-blue-500 hover:bg-blue-800 rounded detail-btn" 
                                            data-id="${val.id}">
                                                <img src="${baseUrl}/img/detail-icon-revisi.png" class="p-1" alt="detail-icon">
                                            </a>`}
                                        <a href="#" class="w-7 h-7 bg-red-600 hover:bg-pink-keruh rounded delete-btn" data-id="${val.id}"><img src="${baseUrl}/img/22706719.png" class="py-1" alt="delete-icon"></a>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });

                        // Initialize Swiper for each product
                        $('.swiper-container').each(function(index, element) {
                            new Swiper(element, {
                                loop: true,
                                pagination: {
                                    el: '.swiper-pagination',
                                },
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                            });
                        });

                        // Deklarasi moment.js untuk format tanggal
                        $.fn.dataTable.moment('D MMMM YYYY');

                        // Inisialisasi DataTables
                        $('#order-table').DataTable({
                            columnDefs: [
                                { targets: 1, type: "date" } // Kolom Tanggal Pemesanan di indeks 1
                            ],
                            order: [[1, 'desc']], // Urutkan default berdasarkan kolom Tanggal Pemesanan
                            scrollY: true,
                            searching: true,
                            columns: [
                                { searchable: true, width: "20%" },  // Nama Pelanggan
                                { searchable: true, width: "20%" }, // Tanggal Pemesanan
                                { searchable: false, width: "14%" }, // Diskon Promo
                                { searchable: true, width: "20%" }, // Status
                                { searchable: false, width: "14%" }, // Total Harga
                                { searchable: false, orderable: false, width: "12%" } // Aksi
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
                    }
                    
                    attachEventListeners();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    tableBody.html('<tr><td colspan="7" class="text-center py-4 text-red-600">Gagal mengambil data produk. Silakan coba lagi nanti.</td></tr>');
                }
            });
        }

        loadOrders();

        function attachEventListeners() {

            $('#order-table').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var pemesananId = $(this).data('id');

                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus pesanan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/pemesanans/delete/' + pemesananId,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                loadOrders();
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
                            title: "Dihapus!",
                            text: "Pesanan berhasil dihapus.",
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
        
    });
</script>
@endsection