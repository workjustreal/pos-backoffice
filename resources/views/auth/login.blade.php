@extends('layouts.master-layout', ['page_title' => 'Login'])
@section('content')
    <div class="container">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <img src="{{ URL::asset('assets/images/logo.png') }}" alt="logo" class="h40">
                                    </div>
                                    <p class="text-muted mb-4 mt-3">ยินดีต้อนรับ KACEE Application</p>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div><br>
                                @endif
                                @if (session('success'))
                                    <div class=" alert alert-success">{{ session('success') }}</div><br>
                                @endif

                                @if (sizeof($errors) > 0)
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">รหัสพนักงาน หรือ รหัสผ่าน ไม่ถูกต้อง</div><br>
                                        @endforeach
                                    </ul>
                                @endif
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label fw-normal">รหัสพนักงาน</label>
                                        <input class="form-control" type="text" name="email" id="email"
                                            required="" maxlength="6" placeholder="ใส่รหัสพนักงาน">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-normal">รหัสผ่าน</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="ใส่รหัสผ่าน">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid mt-5">
                                        <button id="btn-login" class="btn btn-danger" type="submit"> Log In </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
