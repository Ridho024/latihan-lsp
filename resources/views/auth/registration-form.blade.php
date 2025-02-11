@extends('layouts.authentication')
@section('title', 'LSP Ticketing | Registration')

@section('content')

<div class="content d-flex justify-content-center">

    <div class="col-sm-6 my-5">
        <div class="d-flex justify-content-center">
            <div>
                <div class="card border border-0 shadow" style="width: 40rem;">
                    <h4 class="card-header text-center">Registration</h4>
                    <div class="card-body">
                        <form action="{{ route('registrationProcess') }}" method="post">
                            @csrf
                            @error('registrationFailed')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="inputNama" class="form-label fs-5">Nama</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control mb-1 @error('nama') is-invalid @enderror" id="inputNama" aria-describedly="inputNama"/>
                                    @error('nama')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputEmail" class="form-label fs-5">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control mb-1 @error('email') is-invalid @enderror" id="inputEmail"/>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="inputNomorTelepon" class="form-label fs-5">Nomor Telepon</label>
                                    <input type="number" name="nomor_telepon" value="{{ old('nomor_telepon') }}" class="form-control mb-1 @error('nomor_telepon') is-invalid @enderror" id="inputNomorTelepon" aria-describedly="inputNomorTelepon"/>
                                    @error('nomor_telepon')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputJenisKelamin" class="form-label fs-5">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select" id="inputJenisKelamin">
                                        <option selected>Pilih</option>
                                        <option value="L" selected="@if(old('jenis_kelamin') == 'L') true @else '' @endif">Laki - laki</option>
                                        <option value="P" selected="@if(old('jenis_kelamin') == 'P') true @else '' @endif">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="inputPassword" class="form-label fs-5">Password</label>
                                    <input type="password" name="password" class="form-control mb-1 @error('password') is-invalid @enderror" id="inputPassword" aria-describedly="inputPassword"/>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputPasswordConfirmation" class="form-label fs-5">Password Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control mb-1 @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" aria-describedly="inputPasswordConfirmation"/>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-1 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark" style="width: 10rem;">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Sudah mempunyai akun? <a href="{{ route('loginForm') }}">Login</a> | <a href="{{ route('homePage') }}">Kembali</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection