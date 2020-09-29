@extends('admin.layouts.app')

@section('title', 'Login')

@section('body')

<body>
    @endsection

    @section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Selamat Datang di Sistem E-Surat Busungbiu</h5>
                                <p class="text-white-50">Silahkan admin login terlebih dahulu.</p>
                                <a href="#" class="logo logo-admin">
                                    <img src="{{ asset('assets/images/busungbiu-logo.png') }}" height="50" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="form-horizontal mt-4" method="POST" action="{{ route('admin.login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input name="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" id="username" placeholder="Enter username"
                                            autocomplete="username" autofocus>
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password"
                                            class="form-control  @error('password') is-invalid @enderror" id="password"
                                            placeholder="Enter password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Ingatkan Saya</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light"
                                                type="submit">Masuk</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p class="mb-0">© <script>
                                document.write(new Date().getFullYear())
                            </script> {{ config('app.name') }} Pemerintah Desa Busungbiu <i class="mdi mdi-heart text-danger"></i>
                            PKL UNDIKSHA</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection