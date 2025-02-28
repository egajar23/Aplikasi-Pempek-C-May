@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Tanggal Pesanan</th>
                <th>Status</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td>{{ $pesanan->id }}</td>
                <td>{{ $pesanan->pelanggan->nama }}</td>
                <td>{{ $pesanan->tanggal_pesanan }}</td>
                <td>{{ $pesanan->status }}</td>
                <td>Rp {{ number_format($pesanan->total_harga, 2) }}</td>
                <td>
                    <a href="{{ route('pesanans.show', $pesanan) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection