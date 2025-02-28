@extends('admin.layouts.app')
@section('content')

<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="bg-white lg:col-span-2 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Jumlah Pelanggan</h3>
            <p class="text-2xl font-bold text-hijau-toska" id="data-pelanggan"></p>
        </div>
        <div class="bg-white lg:col-span-2 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Pesanan Aktif</h3>
            <p class="text-2xl font-bold text-hijau-toska" id="data-pesanan"></p>
        </div>
    </div>
</div>

<div class="mt-5 p-4 border-2 border-gray-200 rounded-lg">
    <form class="flex justify-center space-x-4 mb-10" id="report-form">
        @csrf
        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
            <select id="tahun" name="tahun" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <!-- Tambahkan tahun lain jika diperlukan -->
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Tampilkan</button>
        </div>
    </form>
    <div class="w-full max-w-5xl mx-auto bg-white shadow-lg p-6 rounded" id="padding">
        <h1 class="text-2xl font-bold text-center mb-4" id="message">Penghasilan Tahunan</h1>
        <canvas id="incomeChart"></canvas>
    </div>
</div>
    
@endsection

@section('script')
<script>
    $(document).ready(function() {

        const today = new Date();
        const currentMonth = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        const currentYear = today.getFullYear();
        let myLineChart = null;

        // Atur nilai default untuk bulan dan tahun
        $('#tahun').val(currentYear);

        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

            function loadDataTest() {

                $.ajax({
                    url: '/api/testing',
                    method: 'GET',
                    data: {
                        year:$('#tahun').val(),
                    },
                    success: function(response) {
                        
                        console.log(response);
                        // let myLineChart;
                        if(myLineChart){

                            myLineChart.destroy();
                        }
                        var productContainer = $('#message');
                        var chartCanvas = $('#incomeChart');
                        var paddingContainer = $('#padding');

                        productContainer.empty();
                        productContainer.append(`<h1 class="text-2xl font-bold text-center mb-4" id="message">Penghasilan Bulanan</h1>`)
                        
                        if (response.length === 0) {
                            // Jika tidak ada data
                            productContainer.empty();
                            chartCanvas.addClass('hidden');
                            paddingContainer.removeClass('p-6');
                            productContainer.append(`
                                    <div class="text-center text-gray-500 py-2">
                                        Tidak ada data penjualan untuk tahun yang dipilih.
                                    </div>
                            `);
                            

                            return;
                        }

                        paddingContainer.addClass('p-6');

                        const incomes = response.map(item => item.income);

                        const labels = response.map(item => {
                            const [, month] = item.month.split('-'); // Hanya ambil bagian bulan
                            return monthNames[parseInt(month) - 1]; // Ambil nama bulan dari array
                        });

                        // Generate chart
                            myLineChart = new Chart($('#incomeChart'), {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Penghasilan (Rp)',
                                    data: incomes,
                                    backgroundColor: 'rgba(252, 205, 42, 1)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
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

        function LoadCustomers(){
            $.ajax({
                url: '/api/pelanggan',
                method: 'GET',
                success: function(response) {
                        
                    $("#data-pelanggan").empty();
                    $("#data-pelanggan").text(response.length);
                        
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

        function LoadOrders(){
            $.ajax({
                url: '/api/pemesanans',
                method: 'GET',
                success: function(response) {
                        
                    $("#data-pesanan").empty();
                    // console.log(response.alamat[0]);
                    let count = 0;
                    response.forEach(function(order){

                        if(order.status != "Dikonfirmasi" && order.status != "Dibatalkan"){
                            count++;
                        }
                    
                    });
                    console.log(count);
                    $("#data-pesanan").text(count);
                        
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal mengambil data pesanan.",
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
        loadDataTest();
        LoadCustomers();
        LoadOrders();

        $('#report-form').submit(function(e) {
            e.preventDefault();


            loadDataTest();

        });
        
        
    });
</script>

@endsection