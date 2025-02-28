<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Profil</title>

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

            <section class="bg-gradient-to-b from-putih to-hijau-keruh">
                <div class="w-10/12 mt-44 mb-20 mx-auto">
                    <div class="bg-white rounded-xl shadow-[0_4px_24px_4px_rgba(0,0,0,0.25)]">
                        <div class="pt-7">
                            <div class="w-11/12 flex justify-between mx-auto">
                                <h3 class="text-4xl font-bold text-hijau mt-3">PROFIL</h3>
                                <div class="w-40 h-14 py-3 bg-hijau-tua rounded-full text-center shadow-[0_4px_18px_rgba(0,0,0,0.25) hover:bg-gradient-to-b hover:from-hijau-muda hover:to-hijau-tua">
                                    <button class="text-kuning-muda font-bold text-2xl edit-button" id="EditProfileButton">Ubah Profil</button>
                                </div>
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto border-2 border-solid border-pink-keruh mt-5"></div>

                        <div class="w-11/12 mx-auto mt-7">
                            <div class="grid grid-cols-12">
                                <div class="col-span-2 relative">
                                    <div class="col-span-2 row-span-4 flex items-center w-40 h-40" id="ProfileImage">    
                                    </div>
                                    <button class="w-10 h-10 absolute bg-abu-abu rounded-full bottom-[-6px] right-10 flex justify-center items-center cursor-pointer hover:bg-gray-400" id="ProfileImageButton">
                                        <img src="{{ asset("img/edit.png") }}" alt="edit-pict" class="w-6 h-6">
                                    </button>
                                </div>
                                <div class="col-span-10 row-span-4">
                                    <h3 class="ml-3 mt-5 mb-3 text-4xl font-bold text-hijau" id="name"></h3>
                                    <div class="w-40 h-14 py-3.5 bg-gradient-to-r from-kuning-muda to-kuning-keruh text-center rounded-full shadow-[0_4px_18px_rgba(0,0,0,0.25)] hidden cursor-pointer" id="membership-container">
                                        <button class="w-full text-pink-keruh text-xl font-bold" id="membership-button">Keanggotaan</button>
                                    </div>
                                    <div class="mx-auto border-2 border-solid border-abu-abu mt-10"></div>
                                </div>
                            </div>
                        </div>
                        <div class="w-11/12 mx-auto grid grid-cols-12 mt-5" id="space-member">
                            <div class="col-start-3 col-span-3 row-span-4">
                                <h3 class="text-2xl font-semibold text-hijau mb-5">Nama:</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">No. Telphone:</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">Email:</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">Kode Pos:</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-20">Alamat:</h3>
                            </div>
                            {{-- <div class="col-start-7 col-span-6 row-span-4">
                                <h3 class="text-2xl font-semibold text-hijau mb-5">{{ Auth::user()->name }}</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">{{ Auth::user()->no_hp }}</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">{{ Auth::user()->email }}</h3>
                                <p class="text-2xl font-semibold text-hijau mb-6">
                                    {{ Auth::user()->address }}
                                </p>
                                <h3 class="text-2xl font-semibold text-hijau">12321</h3>
                            </div> --}}
                            <div class="col-start-7 col-span-6 row-span-4" id="DetailProfile">
                                
                            </div>
                        </div>
                        <div class="pb-5">
                            <div class="w-10/12 h-15 py-3 mx-auto bg-gradient-to-r from-coklat-muda to-coklat-tua text-center rounded-full shadow-[0_4px_18px_rgba(0,0,0,0.25)] hover:bg-gradient-to-r hover:from-coklat-tua hover:to-coklat-tua">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-kuning-keruh text-2xl font-bold">Keluar</button>
                                    {{-- <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <x-footer></x-footer>
            </section>

            <div id="ProfileModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Profile
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="ProfileModal">
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
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                    <input type="text" name="name" id="edit-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                                <div>
                                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor HP</label>
                                    <input type="text" name="no_hp" id="edit-no-hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="edit-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
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

            <div id="editImageModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Ubah Gambar Profil
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editImageModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                            <form id="editImage" class="space-y-4" action="#" method="POST">
                                @csrf
                                <!-- Tambahkan ini di dalam form edit sebelum tombol submit -->
                                <div>
                                    <label for="edit-images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Profil</label>
                                    <input type="file" name="profile_picture" id="edit-images" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" accept="image/*" />
                                </div>
                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="membershipModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Keanggotaan
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="membershipModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 pt-0 md:pt-0">
                            <div class="mt-3 flex justify-between">
                                <span class="text-gray-900 font-normal">Tanggal Mulai Keanggotaan:</span>
                                <div class="w-1/2">
                                    <span class="font-semibold text-coklat-tua" id="membership-date"></span>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-between">
                                <span class="text-gray-900 font-normal">Tanggal Keanggotaan Berakhir:</span>
                                <div class="w-1/2">
                                    <span class="font-semibold text-coklat-tua" id="membership-end-date"></span>
                                </div>
                            </div>
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
            function LoadProfileUsers() {
                // var userId = $(this).data('id');
                $.ajax({
                    url: '/api/pelanggan' ,
                    method: 'GET',
                    data: {
                        pelangganId: pelangganId
                    },
                    success: function(response) {
                        var profileDetails = $('#DetailProfile');
                        let profilePict = $('#ProfileImage');
                        profilePict.empty();
                        profileDetails.empty();

                        
                        // $('#membership-container').
                        if(response.membership){
                            $('#membership-container').removeClass('hidden').addClass('flex');
                            $('#space-member').removeClass('mt-5').addClass('mt-12');
                        }else{
                            $('#space-member').removeClass('mt-12').addClass('mt-5');
                        }

                        var profileHtml = `
                                <h3 class="text-2xl font-semibold text-hijau mb-5">${response.name}</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">${response.no_hp}</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">${response.email}</h3>
                                <h3 class="text-2xl font-semibold text-hijau mb-5">${response.postal_code}</h3>
                                <p class="text-2xl font-semibold text-hijau">
                                    ${response.address}, ${response.city}, ${response.province}
                                </p>
                        `;
                        const link = "{{ asset('profile_picture/')}}"

                        var profileIMG =`
                                <img src="${link}/${response.profile_picture}"
                                alt="User Avatar" 
                                class="w-full h-full object-cover rounded-full">
                                
                        `;
                        const baseUrl = "{{url('/')}}";

                        var defaultProfileIMG =`
                                <img src="${baseUrl}/img/profile.png"
                                alt="User Avatar" 
                                class="w-full h-full object-cover rounded-full">
                                
                        `;
                        console.log(profileIMG)
                        
                        $("#name").empty().text(response.name)
                        profileDetails.append(profileHtml);
                        
                        if(response.profile_picture){
                            profilePict.append(profileIMG);
                        }else{
                            profilePict.append(defaultProfileIMG);
                        }

                        let memberStart = new Date(response.membership_date);

                        let memberEnds = new Date(response.membership_date);
                        memberEnds.setMonth(memberEnds.getMonth() + 6);
                        
                        function formatDate(date) {
                            let day = date.getDate().toString().padStart(2, '0'); // Tambahkan nol di depan jika perlu
                            let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Bulan di JavaScript dimulai dari 0
                            let year = date.getFullYear();
                            return `${day}-${month}-${year}`;
                        }
                        
                        $('#membership-date').text(formatDate(memberStart));
                        $('#membership-end-date').text(formatDate(memberEnds));

                        $('#membership-button').click(function() {
                                const modal = new Modal($('#membershipModal')[0]);
                                modal.show();
                        });

                        
                        attachEventListeners();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal Mengambil Data Pelanggan.",
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
            LoadProfileUsers();

            function attachEventListeners() {
            // Edit Pelanggan
                $('#EditProfileButton').click(function(e) {
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
                            $('#edit-name').val(response.name);
                            $('#edit-no-hp').val(response.no_hp);
                            $('#edit-email').val(response.email);
                            $('#edit-postal-code').val(response.postal_code);
                            $('#edit-province').val(response.province);
                            $('#edit-city').val(response.city);
                            $('#edit-address').val(response.address);
                            
                            const modal = new Modal($('#ProfileModal')[0]);
                            modal.show();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Mengambil Data Pelanggan.",
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

                $('#ProfileImageButton').click(function(e) {
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
                            const modal = new Modal($('#editImageModal')[0]);
                            modal.show();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Mengambil Profil Pelanggan.",
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
                        url: '/api/pelanggan/update-profile/'+pelangganId,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        
                        success: function(response) {
                            showToast('Profil berhasil diperbarui.');
                            const modal = new Modal($('#ProfileModal')[0]);
                            modal.hide();
                            LoadProfileUsers();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Memperbarui Profil Pengguna.",
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

                $('#editImage').submit(function(e) {
                    e.preventDefault();

                    // var pelangganId = $('#edit-id').val();
                    var formData = new FormData(this);
                    // Tambahkan method _method untuk simulate PUT request
                    formData.append('_method', 'PUT');

                    $.ajax({
                        url: '/api/pelanggan/change-image/'+pelangganId,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        
                        success: function(response) {
                            showToast('Gambar Profil berhasil diperbarui.');
                            const modal = new Modal($('#ProfileModal')[0]);
                            modal.hide();
                            LoadProfileUsers();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal Memperbarui Gambar Profil Pengguna.",
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
                            console.error('Error fetching cart count:', xhr.responseText);
                        }
                    });
                }
            }

            updateCartCount();

            $('[data-modal-hide="ProfileModal"]').click(function() {
                const modal = new Modal($('#ProfileModal')[0]);
                modal.hide();
            });


            $('[data-modal-hide="editImageModal"]').click(function() {
                const modal = new Modal($('#editImageModal')[0]);
                modal.hide();
            });

            $('[data-modal-hide="membershipModal"]').click(function() {
                const modal = new Modal($('#membershipModal')[0]);
                modal.hide();
            });

        })
    </script>
    
</html>