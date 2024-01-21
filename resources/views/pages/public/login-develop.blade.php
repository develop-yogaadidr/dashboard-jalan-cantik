@extends('layouts.no-navigation')
@section('content')
    <div style="height:100vh" class="row justify-content-center align-items-center">

        <div class="card mb-4 p-0" style="max-width:800px">
            <div class="card-body px-0 py-0">
                <div class="row mr-0 g-0 justify-content-center align-items-center">
                    <div class="col-5 text-center">
                        <img style="width:150px" src="{{ URL::to('/') }}/public/images/jateng.png" />
                    </div>
                    <div class="col-7" style="background:#FCE9C6; border-left:1px solid #cacaca">
                        <div class="px-5 py-4" style="position:absolute; right:0">
                            <a href="{{ URL::to('/') }}" class="text-dark">
                                <h2><i class="fa fa-home"></i></h2>
                            </a>
                        </div>
                        <div class="p-5">

                            <div class="text-center mb-5">
                                <h4>Jalan Cantik</h4>
                                <p class="mb-4">Selamat Datang, Silahkan Login</p>
                            </div>

                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif

                            <x-form method="post" action="login-development" need-validation class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="email"><i class="fa fa-user"></i></span>
                                    <input name="email" type="text" disabled class="form-control" placeholder="Email"
                                        aria-label="Email" aria-describedby="email" required
                                        value="contoh-username@gmail.com">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="password"><i class="fa fa-lock"></i></span>
                                    <input name="password" disabled type="password" class="form-control"
                                        placeholder="Password" aria-label="Password" aria-describedby="password" required
                                        value="contoh-password">
                                </div>
                                <div class="input-group mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <h6>Login sebagai:</h6>
                                <span>Ini untuk masa development, untuk memudahkan login user</span>
                                <div style="flex">
                                    <button class="btn btn-warning mb-2 btn-sm" type="submit" name="role"
                                        value="admin_provinsi">Admin Provinsi</button>
                                    <button class="btn btn-warning mb-2 btn-sm" type="submit" name="role"
                                        value="admin_jaki">Admin Nasional / JAKI</button>
                                    <button class="btn btn-warning mb-2 btn-sm" type="submit" name="role"
                                        value="admin_kabupaten_kota">Admin Kota/Kabupaten</button>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
