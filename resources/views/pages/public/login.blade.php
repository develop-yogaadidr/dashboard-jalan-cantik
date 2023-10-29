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
                            <a href="{{ URL::to('/') }}" class="text-warning">
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

                            <x-form method="post" action="login" need-validation class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="email"><i class="fa fa-user"></i></span>
                                    <input name="email" type="text" class="form-control" placeholder="Email"
                                        aria-label="Email" aria-describedby="email" required
                                        value="dpupurbalingga@gmail.com">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="password"><i class="fa fa-lock"></i></span>
                                    <input name="password" type="password" class="form-control" placeholder="Password"
                                        aria-label="Password" aria-describedby="password" required value="purbalingga123">
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
                                <div class="input-group mb-3">
                                    <button class="btn btn-warning" style="width:100px" type="submit">Login</button>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
