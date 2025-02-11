@extends('layouts.main')

@section('title', 'LSP Ticketing | Jadwal Penerbangan')

@section('content')

<div class="content row" style="margin: 4rem 8rem 4rem 8rem;">
    <div class="row justify-content-center mb-5">
        <div class="col-sm-6">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <table class="table">
                <thead>
                    <tr class="table-secondary">
                        <th>No</th>
                        <th>Detail Penerbangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal_penerbangan as $penerbangan)
                        <tr class="mt-3">
                            <td>{{ $loop->iteration }}</td>
                            <td class="px-2 py-3">
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Nama Maskapai</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-7">
                                        {{ $penerbangan->nama_maskapai }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Tanggal - Waktu Berangkat</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-7">
                                        {{ $penerbangan->tanggal_berangkat }} - {{ $penerbangan->waktu_berangkat }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Tanggal - Waktu Sampai</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-7">
                                        {{ $penerbangan->tanggal_sampai }} - {{ $penerbangan->waktu_sampai }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Bandara Asal - Tujuan</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-7">
                                        {{ $penerbangan->bandara_asal }} - {{ $penerbangan->bandara_tujuan }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Kursi Tersedia</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-7">
                                        {{ $penerbangan->kursi_tersedia }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4"><strong>Harga / Kursi</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-7">
                                        {{ $penerbangan->harga_per_kursi }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('bookingForm', ['id'=> optional($penerbangan)->id]) }}">Pesan Tiket</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection