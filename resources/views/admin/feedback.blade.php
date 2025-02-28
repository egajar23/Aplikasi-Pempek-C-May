@extends('admin.layouts.app')

@section('content')

<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-2 md:mb-0">Umpan Balik</h2>
        {{-- <button id="addButton" class="bg-hijau-toska text-white px-4 py-2 rounded">Tambah</button> --}}
    </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500 bg-white">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Subjek</th>
                    <th scope="col" class="px-6 py-3">Pesan</th>
                </tr>
            </thead>
            <tbody id="feedbackTableBody">
               
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        function loadfeedbacks() {
            $.ajax({
                url: '/api/show-feedback',
                method: 'GET',
                success: function(response) {
                    var tableBody = $('#feedbackTableBody');
                    tableBody.empty();

                    if(response.length == 0){
                        tableBody.html('<tr><td colspan="4" class="text-center py-4">Tidak ada data umpan balik pengguna.</td></tr>');
                        return;
                    }

                    response.forEach(function(val) {
    
                        var row = `
                            <tr class="border-b">
                                <td class="px-6 py-4">${val.name}</td>
                                <td class="px-6 py-4">${val.email}</td>
                                <td class="px-6 py-4">${val.subject}</td>
                                <td class="px-6 py-4">${val.message}</td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                    
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal mengambil data umpan balik pengguna.",
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
        loadfeedbacks();
        
    });
</script>
@endsection
