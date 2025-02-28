@extends('admin.layouts.app')

@section('content')

<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-2 md:mb-0">Pelanggan</h2>
        {{-- <button id="addButton" class="bg-hijau-toska text-white px-4 py-2 rounded">Tambah</button> --}}
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500 bg-white" id="user-table">
            <thead class="text-xs text-gray-700 uppercase bg-abu-abu">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">No. HP</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Membership</th>
                    <th scope="col" class="px-6 py-3">Aktif</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody id="customerTableBody">
               
            </tbody>
        </table>
    </div>
</div>

<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Pelanggan
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
                <form id="editForm" class="" action="#" method="POST">
                    @csrf
                    <div class="max-h-[450px] overflow-y-auto pb-3 pr-3 space-y-4">
                        <input type="hidden" id="edit-id" name="id">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelanggan</label>
                            <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. HP</label>
                            <input type="text" name="no_hp" id="edit-phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
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
                            <input type="text" name="address" id="edit-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div>
                            <label for="membership" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Member</label>
                            <select id="edit-membership" name="membership" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="1">Aktif</option>
                                <option value="0">Mati</option>
                            </select>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="edit-password" placeholder="Masukkan password baru (opsional)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"/>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"/>
                        </div>
                        <div class="flex items-center ml-2">
                            <input type="checkbox" name="active" id="edit-active" class="form-checkbox h-5 w-5 text-blue-600" />
                            <label for="edit-active" class="ml-2 block text-sm font-medium text-gray-900 dark:text-white">Aktif</label>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan</button>
                </form>
                <div id="error-message" class="text-red-600 hidden pt-2">Password yang dimasukkan tidak sesuai!</div>
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
        const errorMessage = $('#error-message');

        // Load customer data from API
        function loadCustomers() {
            $('#user-table').DataTable().destroy();
            $.ajax({
                url: '/api/pelanggan',
                method: 'GET',
                success: function(response) {
                    var tableBody = $('#customerTableBody');
                    tableBody.empty();

                    response.forEach(function(val) {
                        const user_memberStats = val.membership ? 'Aktif' : 'Mati';
                        const memberStats_font = val.membership ? 'text-blue-600' : 'text-red-600';
                        const memberStats_notif = val.membership ? '' : 'hidden';
                        let WAnumber = val.no_hp;
                        let number = WAnumber.split("");
                        let fixNumber;

                        if(number[0] == '0'){
                            number[0] = '62';
                        }
                        fixNumber = number.join("");
                        console.log(fixNumber);
                        var row = `
                            <tr class="border-b">
                                <td class="px-6 py-4">${val.name}</td>
                                <td class="px-6 py-4">${val.email}</td>
                                <td class="px-6 py-4">${val.no_hp}</td>
                                <td class="px-6 py-4">${val.address}, ${val.city}, ${val.province}, ${val.postal_code}</td>
                                <td class="px-6 py-4 ${memberStats_font}">${user_memberStats}</td>
                                <td class="px-6 py-4">${val.active}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="#" class="w-7 h-7 mt-1 bg-blue-600 hover:bg-blue-800 rounded edit-btn" data-id="${val.id}"><img src="${baseUrl}/img/edit.png" class="p-1" alt="edit-icon"></a>
                                    <a href="#" class="w-7 h-7 mt-1 bg-red-600 hover:bg-pink-keruh rounded delete-btn" data-id="${val.id}"><img src="${baseUrl}/img/22706719.png" class="py-1" alt="delete-icon"></a>
                                    <a href="https://api.whatsapp.com/send?phone=${fixNumber}&text=selamat%20${val.name},%20anda%20mendapatkan%20membership" target="_blank" class="w-8 h-8 hover:opacity-70 notif-btn ${memberStats_notif}" data-id="${val.id}">
                                        <img src="${baseUrl}/img/wa-icon-revisi.png" class="py-0.5" alt="whatsapp-icon">
                                    </a>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                    $('#user-table').DataTable({
                            scrollY: true,
                            searching: true, // Aktifkan pencarian
                            columns: [
                                { searchable: true, width: "15%"},  // Nama Pelanggan
                                { searchable: false, width: "15%"}, // Email
                                { searchable: true, orderable: false, width: "10%"},  // nomor hp
                                { searchable: false, orderable: false, width: "30%"}, // Alamat
                                { searchable: false, width: "10%" },  // Membership
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
                        count++;

                    // Reattach event listeners
                    attachEventListeners();
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
        }

        // Initial load
        loadCustomers();

        // Attach event listeners
        function attachEventListeners() {
            // Edit Pelanggan
            $('#user-table').on('click', '.edit-btn', function(e) {
                e.preventDefault();

                var pelangganId = $(this).data('id');
                
                $.ajax({
                    url: `/api/pelanggan/${pelangganId}`,
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#edit-id').val(response.id);
                        $('#edit-name').val(response.name);
                        $('#edit-email').val(response.email);
                        $('#edit-postal-code').val(response.postal_code);
                        $('#edit-phone').val(response.no_hp);
                        $('#edit-province').val(response.province);
                        $('#edit-city').val(response.city);
                        $('#edit-address').val(response.address);
                        $('#edit-membership').val(response.membership);
                        $('#edit-active').prop('checked', response.active);

                        console.log(response.membership);
                        
                        const modal = new Modal($('#edit-modal')[0]);
                        modal.show();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal mengubah data pelanggan.",
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

            // Hapus Pelanggan
            $('#user-table').on('click', '.delete-btn', function(e) {
                e.preventDefault();

                var pelangganId = $(this).data('id');

                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus pelanggan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/api/pelanggan/delete/' + pelangganId,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                loadCustomers();
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal menghapus pelanggan.",
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
                            text: "Pelanggan berhasil dihapus.",
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

        // Edit form submission
        $('#editForm').submit(function(e) {
            const password = $('#edit-password').val();
            const passwordConfirmation = $('#password_confirmation').val();

            if (password !== passwordConfirmation) {
                e.preventDefault(); // Mencegah form dikirim
                errorMessage.removeClass('hidden');
            }
            e.preventDefault();

            var pelangganId = $('#edit-id').val();
            var formData = new FormData(this);
            formData.set('active', $('#edit-active').prop('checked'));
            
            // Tambahkan method _method untuk simulate PUT request
            formData.append('_method', 'PUT');

            $.ajax({
                url: '/api/pelanggan/' + pelangganId,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    errorMessage.addClass('hidden');
                    showToast('Pelanggan berhasil diperbarui.');
                    const modal = new Modal($('#edit-modal')[0]);
                    modal.hide();
                    loadCustomers();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal memperbarui pelanggan.",
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
    });
</script>
@endsection
