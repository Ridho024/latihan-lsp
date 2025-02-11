@extends('layouts.main')

@section('title', 'LSP Ticketing | My Tickets')

@section('content')

<div class="content row" style="margin: 4rem 8rem 4rem 8rem;">
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
                @if ($my_tickets)
                    <tbody>
                        @foreach ($my_tickets as $ticket)
                            <tr class="mt-3">
                                <td>{{ $loop->iteration }}</td>
                                <td class="px-2 py-3">
                                    <div class="row mb-2">
                                        <div class="col-sm-4"><strong>Nama Maskapai</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            {{ $ticket->schedule->nama_maskapai }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4"><strong>Tanggal - Waktu Berangkat</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            {{ $ticket->schedule->tanggal_berangkat }} - {{ $ticket->schedule->waktu_berangkat }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4"><strong>Tanggal - Waktu Sampai</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            {{ $ticket->schedule->tanggal_sampai }} - {{ $ticket->schedule->waktu_sampai }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4"><strong>Bandara Asal - Tujuan</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            {{ $ticket->schedule->bandara_asal }} - {{ $ticket->schedule->bandara_tujuan }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4"><strong>Kursi</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            {{ $ticket->jumlah_kursi }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-4"><strong>Total Harga</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            {{ $ticket->total_harga }}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4"><strong>Status</strong></div>
                                        <div class="col-sm-1"><strong>:</strong></div>
                                        <div class="col-sm-7">
                                            @if ($ticket->status == 'pending')
                                                <span class="badge text-bg-warning">Belum Dibayar</span>
                                            @elseif($ticket->status == 'paid')
                                                <span class="badge text-bg-success">Dibayar</span>
                                            @elseif($ticket->status == 'canceled')
                                                <span class="badge text-bg-danger">Dibatalkan</span>
                                            @else
                                                <span class="badge text-bg-info">Dikonfirmasi</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($ticket->status == 'pending')
                                        <a class="btn btn-success mb-2" href="{{ route('formPembayaran', ['id' => $ticket->id]) }}">Bayar</a>
                                        <br/> 
                                        <a class="btn btn-danger" href="/">Batalkan</a>
                                    @elseif($ticket->status == 'paid')
                                        <span class="badge text-bg-success">Dibayar</span>
                                    @else
                                        <span class="badge text-bg-info">Dikonfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <div>Kamu belum pernah memesan tiket.</div>
                    </tbody>
                @endif
            </table>
        </div>
    </div>
</div>


@endsection
