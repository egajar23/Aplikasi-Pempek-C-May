@extends('admin.layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <header class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Laporan Keuangan Pempek Bulanan</h1>
    </header>
    <main>
        <section class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between mb-4">
                <h2 class="text-2xl font-semibold ">Filter Laporan</h2>
                <button class="bg-coklat-muda hover:bg-coklat-tua text-white px-4 py-2 rounded" id="download-pdf">
                    Unduh PDF
                </button>
            </div>
            <form class="flex justify-center space-x-4" id="report-form">
                @csrf
                <div>
                    <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="bulan" name="bulan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
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
        </section>
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Data Penjualan Bulanan</h2>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border">Nama Pempek</th>
                        <th class="py-2 px-4 border">Jumlah Terjual</th>
                        <th class="py-2 px-4 border">Harga Satuan</th>
                        <th class="py-2 px-4 border">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <tr>
                        <td class="py-2 px-4 border">Pempek Kapal Selam</td>
                        <td class="py-2 px-4 border">50</td>
                        <td class="py-2 px-4 border">Rp 15.000</td>
                        <td class="py-2 px-4 border">Rp 750.000</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="py-2 px-4 border">Pempek Lenjer</td>
                        <td class="py-2 px-4 border">30</td>
                        <td class="py-2 px-4 border">Rp 10.000</td>
                        <td class="py-2 px-4 border">Rp 300.000</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">Pempek Dos</ <td class="py-2 px-4 border">20</td>
                        <td class="py-2 px-4 border">Rp 12.000</td>
                        <td class="py-2 px-4 border">Rp 240.000</td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="py-2 px-4 border">Pempek Adaan</td>
                        <td class="py-2 px-4 border">40</td>
                        <td class="py-2 px-4 border">Rp 8.000</td>
                        <td class="py-2 px-4 border">Rp 320.000</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6">
                <h3 class="text-xl font-bold">Total Pendapatan Bulanan - Diskon (Bersih): <span class="text-green-600" id="income-monthly">Rp 1.610.000</span></h3>
            </div>
        </section>
    </main>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Load customer data from API
        const baseUrl = "{{url('/')}}"
        const today = new Date();
        const currentMonth = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        const currentYear = today.getFullYear();

            // Atur nilai default untuk bulan dan tahun
        $('#bulan').val(currentMonth);
        $('#tahun').val(currentYear);

        function loadReportProducts() {
            $.ajax({
                url: '/api/report-monthly',
                method: 'GET',
                data: {
                    month: $('#bulan').val(),
                    year: $('#tahun').val(),
                },
                success: function (response) {
                    var productContainer = $('#productTableBody');
                    var income = $('#income-monthly');

                    console.log(response);

                    productContainer.empty();
                    income.empty();

                    if (response.pemesanan.length === 0) {
                        // Jika tidak ada data
                        productContainer.append(`
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    Tidak ada data penjualan untuk bulan dan tahun yang dipilih.
                                </td>
                            </tr>
                        `);
                        income.text(`Rp. 0`);
                        return;
                    }

                    let totalDiscount = 0;
                    let total = 0;
                    let appliedDiscounts = {}; // Untuk melacak pemesanan_id yang diskonnya sudah dihitung
                    let totalMonthlyReport = 0;

                    response.pemesanan.forEach(function(discount){
                        totalDiscount += discount.promo_discount;
                    })

                    response.detail.forEach(function (product) {
                        const pricePerProduct = typeof product.harga_satuan === 'string' ? parseFloat(product.harga_satuan) : product.harga_satuan;
                        const reportTotalProduct = typeof product.total === 'string' ? parseFloat(product.total) : product.total;
                        total += product.total;
                            
                        var productHtml = `
                            <tr>
                                <td class="py-2 px-4 border">${product.produk.name}</td>
                                <td class="py-2 px-4 border">${product.jumlah}</td>
                                <td class="py-2 px-4 border">${pricePerProduct.toLocaleString('id-ID')}</td>
                                <td class="py-2 px-4 border">${reportTotalProduct.toLocaleString('id-ID')}</td>
                            </tr>
                        `;

                        // console.log(total);

                        productContainer.append(productHtml);

                    });

                    totalMonthlyReport = total - totalDiscount;
                    // Tampilkan total penghasilan setelah diskon
                    income.text(`Rp. ${totalMonthlyReport.toLocaleString('id-ID')}`);
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal mengambil data laporan penjualan bulanan.",
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
        loadReportProducts();
        

        $('#report-form').submit(function(e) {
            e.preventDefault();


            loadReportProducts();

        });

        $('#download-pdf').click(function() {
            // console.log($('#bulan').val(), $('#tahun').val())
            window.location.href = `/admin/laporan/unduh?month=${$('#bulan').val()}&year=${$('#tahun').val()}`;
        })
        
    });
</script>
@endsection
