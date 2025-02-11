@extends('layouts.main')

@section('title', 'LSP Ticketing | Booking Tiket')

@section('content')
<div class="content row px-3 justify-content-center" style="margin: 5rem 8rem 5rem 8rem;">
    @if ($penerbangan)
        <div class="col-sm-7">
            <div class="card border border-0 shadow" style="width: 45rem;">
                <h4 class="card-header text-center">{{ $penerbangan->nama_maskapai }}</h4>
                <div class="card-body">
                    <form action="{{ route('processBooking') }}" method="post">
                        @csrf
                        @error('bookingFailed')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('schedule_id')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row align-items-center">
                                    <div class="col-sm-6"><strong>Tanggal Berangkat</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-5">
                                        {{ \Carbon\Carbon::parse($penerbangan->tanggal_berangkat)->format('d - m - Y') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row align-items-center">
                                    <div class="col-sm-5"><strong>Tanggal Sampai</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-6">
                                        {{ \Carbon\Carbon::parse($penerbangan->tanggal_sampai)->format('d - m - Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="row align-items-center">
                                    <div class="col-sm-6"><strong>Waktu Berangkat</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-5">
                                        {{ $penerbangan->waktu_berangkat }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row align-items-center">
                                    <div class="col-sm-5"><strong>Waktu Sampai</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-6">
                                        {{ $penerbangan->waktu_sampai }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-sm-6">
                                <div class="row align-items-center">
                                    <div class="col-sm-6"><strong>Harga / kursi</strong></div>
                                    <div class="col-sm-1"><strong>:</strong></div>
                                    <div class="col-sm-5">
                                        Rp.{{ $penerbangan->harga_per_kursi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-sm-6 justify-content-center">
                                <div class="d-flex flex-column text-center">
                                    <div class="show-total-price mb-3">
                                        <input type="text" name="total_harga" class="text-center" id="total-harga" value="{{ $penerbangan->harga_per_kursi }}" readonly/>
                                        <input type="hidden" name="schedule_id" class="text-center" id="schedule_id" value="{{ $penerbangan->id }}" readonly/>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <button type="button" class="input-group-text" id="tambah-kursi">+</button>
                                            <input type="number" min=1 name="jumlah_kursi" class="form-control text-center" placeholder="Jumlah Kursi" aria-label="Jumlah Kursi" aria-describedby="jumlah-kursi" id="jumlah-kursi" value="1">
                                            <button type="button" class="input-group-text" id="kurangi-kursi">-</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark" style="width: 10rem;">Beli Tiket</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="text-center">Tidak jadi booking? <a href="{{ route('jadwalPenerbangan') }}">Kembali</a></p>
                </div>
            </div>
        </div>
    @else
        <div></div>
    @endif
</div>
@endsection
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let hargaPerKursi = parseInt({{ $penerbangan->harga_per_kursi }}); // Ambil harga per kursi dari Blade
        let jumlahKursiInput = document.getElementById("jumlah-kursi");
        let totalHargaInput = document.getElementById("total-harga");
        
        let tambahBtn = document.getElementById("tambah-kursi");
        let kurangiBtn = document.getElementById("kurangi-kursi");

        function updateTotalHarga() {
            let jumlahKursi = parseInt(jumlahKursiInput.value);
            totalHargaInput.value = hargaPerKursi * jumlahKursi;
        }

        tambahBtn.addEventListener("click", function(e) {
            e.preventDefault();
            jumlahKursiInput.value = parseInt(jumlahKursiInput.value) + 1;
            updateTotalHarga();
        });

        kurangiBtn.addEventListener("click", function(e) {
            e.preventDefault();
            if (parseInt(jumlahKursiInput.value) > 1) {
                jumlahKursiInput.value = parseInt(jumlahKursiInput.value) - 1;
                updateTotalHarga();
            }
        });

        jumlahKursiInput.addEventListener("input", updateTotalHarga);

    });
</script>
@endsection