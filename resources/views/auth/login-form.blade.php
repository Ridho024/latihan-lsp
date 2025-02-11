@extends('layouts.authentication')

@section('title', 'LSP Ticketing | Login')

@section('content')

<div class="content d-flex justify-content-center">

    <div class="col-sm-6 my-5">
        <div class="d-flex justify-content-center">
            <div>
                <div class="card border border-0 shadow" style="width: 25rem;">
                    <h4 class="card-header text-center">Login</h4>
                    <div class="card-body text-center">
                        <form action="{{ route('loginProcess') }}" method="post">
                            @csrf
                            @error('loginFailed')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label fs-5">Email</label>
                                <input type="email" name="email" class="form-control mb-1 @error('email') is-invalid @enderror" id="inputEmail" aria-describedly="emailHelp"/>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label fs-5">Password</label>
                                <input type="password" name="password" class="form-control mb-1 @error('password') is-invalid @enderror" id="inputPassword"/>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <button type="submit" class="btn btn-dark">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Belum memiliki akun? <a href="{{ route('registrationForm') }}">Register</a> | <a href="{{ route('homePage') }}">Kembali</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection