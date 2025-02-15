@extends('layouts.main')
@section('title', 'LSP Ticketing | Homepage')

@section('content')
<div class="content row shadow px-3" style="margin: 5rem 8rem 5rem 8rem; height: 25rem; align-items:center;">
    <div class="col-sm-7">
        <div class="row align-item-center">
            <div class="col-12">
                <h2>Cari Penerbangan mu</h2>
                <p>
                    Dapatkan diskon sampai 10% untuk penerbangan domestik khusus tahun baru.
                    <br/>
                    Mulai terbang dari Sabang sampai Merauke dengan harga yang terjangkau.
                    <br/>
                    Khusus untuk pengguna baru dapatkan diskon untuk penginapan dua kasur 12%.
                </p>
            </div>
            <div class="col-12">
                <a class="btn btn-secondary shadow" href="{{ route('jadwalPenerbangan') }}">Lihat Penerbangan</a>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <form action="{{ route('cariPenerbangan') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div>Bandara Asal</div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="bandara-asal">@</span>
                        <input type="text" name="bandara_asal" class="form-control" placeholder="Bandara Keberangkatan" aria-label="Bandara Asal" aria-describedby="bandara-asal">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>Bandara Tujuan</div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="bandara-tujuan">@</span>
                        <input type="text" name="bandara_tujuan" class="form-control" placeholder="Bandara Tujuan" aria-label="Bandara Tujuan" aria-describedby="bandara-tujuan">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div>Tanggal Berangkat</div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="tanggal-berangkat">@</span>
                        <input type="date" name="tanggal_berangkat" class="form-control" placeholder="Tanggal Berangkat" aria-label="Tanggal Berangkat" aria-describedby="tanggal-berangkat">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div>Tanggal Sampai</div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="tanggal-sampai">@</span>
                        <input type="date" name="tanggal_sampai" class="form-control" placeholder="Tanggal Sampai" aria-label="Tanggal Sampai" aria-describedby="tanggal-sampai">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center px-3">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
        </form>
    </div>
</div>

@if ($hasil_pencarian)
<div class="content d-flex justify-content-center">
    <div class="col-sm-10">
    
        <table class="table ">
            <thead>
                <tr class="table-secondary">
                    <th>No</th>
                    <th>Detail Penerbangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil_pencarian as $penerbangan)
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
                            <a class="btn btn-secondary" href="/">Pesan Tiket</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>    

    </div>
</div>
@else
<div></div>
@endif
@endsection