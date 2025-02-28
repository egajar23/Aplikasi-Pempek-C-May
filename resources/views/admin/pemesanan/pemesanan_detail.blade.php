@extends('admin.layouts.app')

@section('content')
<div class="p-4 border-2 border-gray-200 rounded-lg">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-2 md:mb-0">Detail Pemesanan</h2>
        <a href="{{ route('admin.pemesanan') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    @if($pemesanan->status == 'Dibayar')
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Konfirmasi Pemesanan
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        bukti Transfer
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <img class="w-72 h-72 object-cover rounded-lg shadow-md" src="{{ asset('bukti_transfer/' . $pemesanan->bukti_transfer) }}" alt="Bukti Transfer">
                    </dd>
                </div>
                <!-- Tombol Konfirmasi dan Batal -->
                <div class="flex gap-4 mt-6">
                    <button id="confirm-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-1/2">Konfirmasi</button>
                    <button id="cancel-btn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-1/2">Batal</button>
                </div>
            </dl>
        </div>
    </div>
    @endif
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Informasi Pemesanan
            </h3>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Pelanggan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pemesanan->user->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tanggal Pesanan
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y') }}

                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Status
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pemesanan->status }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Promo
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pemesanan->promo_code ? $pemesanan->promo_code : '-' }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Metode Pengiriman
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pemesanan->type_pengiriman }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Diskon Promo
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pemesanan->promo_discount ? 'Rp ' . number_format($pemesanan->promo_discount, 0, ',', '.') : '-' }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Ongkos Kirim
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        Rp {{ number_format($pemesanan->ongkir, 0, ',', '.') }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Total Harga
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Notes
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $pemesanan->notes ? $pemesanan->notes : "-" }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-8">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
            Detail Produk
        </h3>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full text-sm text-left text-gray-500 bg-white">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Produk</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Harga Satuan</th>
                        <th scope="col" class="px-6 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan->detailPemesanan as $detail)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $detail->produk->name }}</td>
                        <td class="px-6 py-4">{{ $detail->jumlah }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($detail->jumlah * $detail->harga_satuan, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        // Handle Konfirmasi
        $('#confirm-btn').click(function () {
            let pemesananId = {{ $pemesanan->id }};
            
            $.ajax({
                url: `/api/pemesanans/${pemesananId}/konfirmasi`,
                method: 'POST',
                processData: false,
                contentType: false,
                success: function (res) {
                    // console.log(res.user_membership);
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#status').text('Dibayar');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan",
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

        // Handle Batal
        $('#cancel-btn').click(function () {
            let pemesananId = {{ $pemesanan->id }};
            
            $.ajax({
                url: `/api/pemesanans/${pemesananId}/batal`,
                method: 'POST',
                processData: false,
                contentType: false,
                success: function (res) {
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#status').text('Dibatalkan');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan",
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
    });
</script>
@endsection