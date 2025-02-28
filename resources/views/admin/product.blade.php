@extends('admin.layouts.app')

@section('content')


<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-2 md:mb-0">Produk</h2>
        <button id="addButton" class="bg-hijau-toska text-white px-4 py-2 rounded">Tambah</button>
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500 bg-white" id="product-table">
            <thead class="text-xs text-gray-700 bg-abu-abu">
                <tr>
                    <th scope="col" class="px-6 py-3 uppercase">Nama</th>
                    <th scope="col" class="px-6 py-3 w-[30%] uppercase">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 uppercase">Tipe</th>
                    <th scope="col" class="px-6 py-3">HARGA (Rp.)</th>
                    <th scope="col" class="px-6 py-3 uppercase">Stok</th>
                    <th scope="col" class="px-6 py-3 uppercase">Aktif</th>
                    <th scope="col" class="px-6 py-3 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
            </tbody>
        </table>
    </div>
</div>

<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <!-- Modal content -->
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Produk
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal">
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
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug Produk</label>
                        <input type="text" name="slug" id="edit-slug" placeholder="nama produk tanpa spasi. Contoh: kapal-selam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="description" id="edit-description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                    </div>
                    {{-- <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Produk</label>
                        <input type="text" name="type" id="edit-type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div> --}}
                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Produk</label>
                        <select id="edit-type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="Frozen">Frozen</option>
                            <option value="Paket">Paket</option>
                            <option value="Siap Saji">Siap Saji</option>
                        </select>                        
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="number" name="price" id="edit-price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat (Kg)</label>
                        <input type="number" name="weight" id="edit-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input type="number" name="stock" id="edit-stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <!-- Tambahkan ini di dalam form edit sebelum tombol submit -->
                    <div>
                        <label for="edit-images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk</label>
                        <input type="file" name="images[]" id="edit-images" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" multiple />
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="active" id="edit-active" class="form-checkbox h-5 w-5 text-blue-600" />
                        <label for="edit-active" class="ml-2 block text-sm font-medium text-gray-900 dark:text-white">Aktif</label>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Tambah Produk Baru
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5 pt-0 md:pt-0">
                <form id="addForm" class="space-y-4" action="#" method="POST">
                    @csrf
                    <div>
                        <label for="add-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="name" id="add-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="add-slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug Produk</label>
                        <input type="text" name="slug" id="add-slug" placeholder="nama produk tanpa spasi. Contoh: kapal-selam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="add-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="description" id="add-description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                    </div>
                    {{-- <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Produk</label>
                        <input type="text" name="type" id="edit-type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div> --}}
                    <div>
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Produk</label>
                        <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="Frozen">Frozen</option>
                            <option value="Paket">Paket</option>
                            <option value="Siap Saji">Siap Saji</option>
                        </select>                        
                    </div>
                    <div>
                        <label for="add-price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="number" name="price" id="add-price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="add-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat (Kg)</label>
                        <input type="number" name="weight" id="add-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="add-stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input type="number" name="stock" id="add-stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="add-images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk</label>
                        <input type="file" name="images[]" id="add-images" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" multiple required />
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="active" id="add-active" class="form-checkbox h-5 w-5 text-blue-600" />
                        <label for="add-active" class="ml-2 block text-sm font-medium text-gray-900 dark:text-white">Aktif</label>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="image-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-screen bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="image-modal-title">
                    Gambar Produk
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
        const baseUrl = "{{ url('/') }}";
        let count = 1;
       
        function loadProducts() {
            var tableBody = $('#productTableBody');
            $('#product-table').DataTable().destroy();
            // Show loading indicator
            tableBody.html('<tr><td colspan="7" class="text-center py-4">Loading...</td></tr>');

            $.ajax({
                url: '/api/products',
                method: 'GET',
                success: function(response) {
                    tableBody.empty();
                    // $('#product-table').DataTable().ajax.reload();
                    
                    if (response.length === 0) {
                        // No data available
                        tableBody.html('<tr><td colspan="7" class="text-center py-4">Tidak ada produk tersedia.</td></tr>');
                    } else {
                        response.forEach(function(product) {
                            const price = typeof product.price === 'string' ? parseFloat(product.price) : product.price;
                            var row = `
                                <tr class="border-b">
                                    <td class="px-6 py-4">${product.name}</td>
                                    <td class="px-6 py-4 w-32">${product.description}</td>
                                    <td class="px-6 py-4">${product.type}</td>
                                    <td class="px-6 py-4">${price.toLocaleString('id-ID')}</td>
                                    <td class="px-6 py-4">${product.stock}</td>
                                    <td class="px-6 py-4">${product.active ? 'Ya' : 'Tidak'}</td>
                                    <td class="px-6 py-4 flex gap-x-2">
                                        <a href="#" class="w-7 h-7 mt-2 bg-hijau-toska hover:bg-hijau-tua rounded" data-id="${product.id}"><img src="${baseUrl}/img/photos-icon.png" class="p-1" alt="show-img-icon"></a>
                                        <a href="#" class="w-7 h-7 mt-2 bg-blue-600 hover:bg-blue-800 rounded edit-btn" data-id="${product.id}"><img src="${baseUrl}/img/edit.png" class="p-1" alt="edit-icon"></a>
                                        <a href="#" class="w-7 h-7 mt-2 bg-red-600 hover:bg-pink-keruh rounded delete-btn" data-id="${product.id}"><img src="${baseUrl}/img/22706719.png" class="py-1" alt="delete-icon"></a>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });
                        
                        $('#product-table').DataTable({
                            scrollY: true,
                            searching: true, // Aktifkan pencarian
                            columns: [
                                { searchable: true, width: "20%"},  // Nama
                                { searchable: false, orderable: false, width: "30%"}, // Deskripsi
                                { searchable: true, width: "10%"},  // Tipe
                                { searchable: false, width: "10%"}, // Harga
                                { searchable: true, width: "10%" },  // Stok
                                { searchable: false, width: "8%" }, // Aktif
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
                        // new DataTable('#product-table');
                        // $('#product-table').DataTable();
                        // $('#dt-length-0').DataTable();
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

        loadProducts();

        function attachEventListeners() {
            $('#product-table').on('click', '.edit-btn', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                
                $.ajax({
                    url: `/api/products/${productId}`,
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        console.log(response,productId)
                        $('#edit-id').val(response.id);
                        $('#edit-name').val(response.name);
                        $('#edit-slug').val(response.slug);
                        $('#edit-description').val(response.description);
                        $('#edit-type').val(response.type);
                        $('#edit-price').val(response.price);
                        $('#edit-weight').val(response.weight);
                        $('#edit-stock').val(response.stock);
                        $('#edit-active').prop('checked', response.active);
                        
                        const modal = new Modal($('#edit-modal')[0]);
                        modal.show();
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
            });

            $('#product-table').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');

                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus produk ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/products/delete/' + productId,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                
                                

                                loadProducts();
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal menghapus produk.",
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
                            text: "Produk berhasil dihapus.",
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

            // Add new event listener for the "Tambah Produk" button
            $('#addButton').click(function() {
                const modal = new Modal($('#add-modal')[0]);
                modal.show();
            });

            
        }
        // Update the add product form submission
       $('#addForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            formData.set('active', $('#add-active').prop('checked'));

            // Log FormData contents (for debugging)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
           
           console.log(formData)
        //    return
           $.ajax({
                url: '/api/products',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                        showToast('Produk berhasil ditambahkan.');
                        const modal = new Modal($('#add-modal')[0]);
                        modal.hide();
                        $('#addForm')[0].reset();
                        
                        loadProducts();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal menambahkan produk.",
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
        // Update the edit product form submission
        // $('#editForm').submit(function(e) {
        //     e.preventDefault();
        //     var productId = $('#edit-id').val();
        //     var formData = $(this).serializeArray();
            
        //     // Convert active checkbox to boolean
        //     var activeField = formData.find(field => field.name === 'active');
        //     if (activeField) {
        //         activeField.value = activeField.value === 'on';
        //     } else {
        //         formData.push({ name: 'active', value: false });
        //     }

        //     $.ajax({
        //         url: '/api/products/' + productId,
        //         method: 'PUT',
        //         data: $.param(formData),
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //         },
        //         success: function(response) {
        //             showToast('Produk berhasil diperbarui.');
        //             const modal = new Modal($('#edit-modal')[0]);
        //             modal.hide();
        //             loadProducts();
        //         },
        //         error: function(xhr) {
        //             alert('Gagal memperbarui produk.');
        //             console.error(xhr.responseText);
        //         }
        //     });
        // });

        // Update bagian submit form edit
        $('#editForm').submit(function(e) {
            e.preventDefault();
            var productId = $('#edit-id').val();
            
            // Gunakan FormData untuk menangani file upload
            var formData = new FormData(this);
            formData.set('active', $('#edit-active').prop('checked'));
            
            // Tambahkan method _method untuk simulate PUT request
            formData.append('_method', 'PUT');

            $.ajax({
                url: '/api/products/' + productId,
                method: 'POST', // Gunakan POST untuk FormData
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    showToast('Produk berhasil diperbarui.');
                    const modal = new Modal($('#edit-modal')[0]);
                    modal.hide();
                    
                    // $('#product-table').DataTable().ajax.reload();
                    // $('#product-table').DataTable().destroy();
                    

                    loadProducts();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal memperbarui produk.",
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
        

        // Close modal button
        $('[data-modal-hide="edit-modal"]').click(function() {
            const modal = new Modal($('#edit-modal')[0]);
            modal.hide();
        });
        // Add a new event listener for closing the add modal
        $('[data-modal-hide="add-modal"]').click(function() {
            const modal = new Modal($('#add-modal')[0]);
            modal.hide();
        });

        function showImageModal(productId) {
        // Show loading state
        $('#image-container').html('<div class="col-span-3 text-center py-4">Loading...</div>');
        $('#image-modal').removeClass('hidden').addClass('flex');
        
        // Fetch product images
        $.ajax({
            url: `/api/products/${productId}`,
            method: 'GET',
            success: function(product) {
                console.log(product)
                var container = $('#image-container');
                container.empty();
                
                if (product.images && product.images.length > 0) {
                    product.images.forEach(function(image) {
                        console.log(image.image_path)
                        var imgDiv = $('<div>')
                            .addClass('relative aspect-square')
                            .append(    
                                $('<img>')
                                    .attr('src', `${baseUrl}/product/${image.image_path}`)
                                    .attr('alt', 'Product image')
                                    .addClass('h-full w-full rounded-lg object-cover')
                                    .on('error', function() {
                                        $(this)
                                            .attr('src', '//placeholder/400/400')
                                            .off('error');
                                    })
                            );
                        container.append(imgDiv);
                    });
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

    // Event delegation for image viewer links
    $(document).on('click', 'a[data-id]:not(.edit-btn):not(.delete-btn)', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        showImageModal(productId);
    });

    // Close modal when clicking close button
    $(document).on('click', '.close-image-modal', function() {
        closeImageModal();
    });

    // Close modal when clicking outside
    $(document).on('click', '#image-modal', function(e) {
        if ($(e.target).is('#image-modal')) {
            closeImageModal();
        }
    });

    // Close modal on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && !$('#image-modal').hasClass('hidden')) {
                closeImageModal();
            }
        });
    });
</script>
@endsection