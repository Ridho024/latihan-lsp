@extends('layouts.main')
@section('title', 'LSP Ticketing | Form Pembayaran')

@section('content')

<div class="content d-flex justify-content-center">

    <div class="col-sm-6 my-5">
        <div class="d-flex justify-content-center">
            <div>
                <div class="card border border-0 shadow" style="width: 40rem;">
                    <h4 class="card-header text-center">Pembayaran Tiket</h4>
                    <div class="card-body">
                        @if(session('paymentSuccess'))
                            <div class="alert alert-success">
                                {{ session('paymentSuccess') }}
                            </div>

                            <script>
                                setTimeout(function() {
                                    window.location.href = "{{ route('userTicket') }}";
                                }, 3000); // Redirect setelah 3 detik
                            </script>
                        @endif
                        @if ($booking)
                            <form action="{{ route('processPayment') }}" method="post">
                                @csrf
                                @error('paymentFailed')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}"/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="inputEmail" class="form-label fs-5">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-1 @error('email') is-invalid @enderror" id="inputNama" aria-describedly="inputEmail"/>
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputMetodePembayaran" class="form-label fs-5">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" class="form-select" id="inputMetodePembayaran">
                                            <option selected>Pilih</option>
                                            <option value="cash" selected="@if(old('cash') == 'cash') true @else '' @endif">Cash</option>
                                            <option value="debit" selected="@if(old('debit') == 'debit') true @else '' @endif">Debit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="inputNomorKartu" class="form-label fs-5">Nomor Kartu</label>
                                        <input type="number" name="nomor_kartu" value="{{ old('nomor_kartu') }}" class="form-control mb-1 @error('nomor_kartu') is-invalid @enderror" id="inputNomorKartu" aria-describedly="inputNomorKartu"/>
                                        @error('nomor_kartu')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="inputNominalPembayaran" class="form-label fs-5">Nominal Pembayaran</label>
                                        <input type="number" name="total_pembayaran" value="{{ $booking->total_harga }}" class="form-control mb-1 @error('total_pembayaran') is-invalid @enderror" id="inputNominalPembayaran" aria-describedly="inputNominalPembayaran" readonly/>
                                        @error('total_pembayaran')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark" style="width: 10rem;">Bayar</button>
                                </div>
                            </form>
                        @else
                            <div>Booking Tidak ditemukan</div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Tidak jadi bayar? <a href="{{ route('userTicket') }}">Kembali</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let metodePembayaran = document.getElementById("inputMetodePembayaran");
        let nomorKartu = document.getElementById("inputNomorKartu");

        function toggleNomorKartu() {
            if (metodePembayaran.value === "cash") {
                nomorKartu.setAttribute("readonly", "true");
                nomorKartu.setAttribute("type", "text")
                nomorKartu.value = "Metode pembayaran ini tidak perlu nomor kartu"; // Kosongkan input jika cash dipilih
            } else {
                nomorKartu.removeAttribute("readonly");
                nomorKartu.value = "";
            }
        }

        // Panggil saat halaman dimuat
        toggleNomorKartu();

        // Tambahkan event listener untuk perubahan pada select
        metodePembayaran.addEventListener("change", toggleNomorKartu);
    });
</script>
@endsection