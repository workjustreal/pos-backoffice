@extends('layouts.master-layout', ['page_title' => "โปรไฟล์"])
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">KACEE</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                        <li class="breadcrumb-item active">โปรไฟล์</li>
                    </ol>
                </div>
                <h4 class="page-title">โปรไฟล์</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="card-box">
                        <img src="{{asset('assets/images/users/user-1.jpg')}}"
                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0">{{ $user->name . ' ' . $emp->surname }}</h4>
                        <p class="text-primary">{!! '@'.$user->emp_id !!}</p>

                        <div class="text-start mt-3">
                            @if ($emp->detail != "")
                            <h4 class="font-14 text-uppercase">About Me :</h4>
                            <p class="text-muted font-14 mb-3">
                                {{ $emp->detail }}
                            </p>
                            @endif
                            <p class="text-muted mb-2 font-14"><strong>ชื่อ-สกุล :</strong> <span class="ms-2">{{
                                    $emp->name . ' ' . $emp->surname }}</span></p>
                            <p class="text-muted mb-2 font-14"><strong>เบอร์สำนักงาน :</strong><span class="ms-2">{{
                                    $emp->tel }}</span></p>
                            <p class="text-muted mb-2 font-14"><strong>เบอร์มือถือ :</strong><span class="ms-2">{{
                                    $emp->phone }}</span></p>
                            <p class="text-muted mb-2 font-14"><strong>อีเมล :</strong> <span class="ms-2">{{
                                    $emp->email }}</span></p>
                            <p class="text-muted mb-2 font-14"><strong>แผนก :</strong> <span class="ms-2">{{
                                    $emp->dept_desc }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-box">
                        <ul class="nav nav-pills nav-fill navtab-bg">
                            <li class="nav-item">
                                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link @if (blank($errors)) active @endif">
                                    เกี่ยวกับฉัน
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#personal" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                    ข้อมูลส่วนตัว
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link @if (!blank($errors)) active @endif">
                                    แก้ไข
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane @if (blank($errors)) show active @endif" id="aboutme">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                    ข้อมูลพนักงาน</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ชื่อ</label>
                                            <input type="text" class="form-control" value="{{ $emp->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">นามสกุล</label>
                                            <input type="text" class="form-control" value="{{ $emp->surname }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ชื่อเล่น</label>
                                            <input type="text" class="form-control" value="{{ $emp->nickname }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">รหัสพนักงาน</label>
                                            <input type="text" class="form-control" value="{{ $emp->emp_id }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">สาขา</label>
                                            <input type="text" class="form-control" value="{{ $emp->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">แผนก</label>
                                            <input type="text" class="form-control" value="{{ $emp->dept_desc }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ตำแหน่ง</label>
                                            <input type="text" class="form-control" value="{{ $emp->position_desc }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ประเภทพนักงาน</label>
                                            <input type="text" class="form-control"
                                                value="{{ ($emp->payment_type=='M') ? 'รายเดือน' : 'รายวัน' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">สถานะพนักงาน</label>
                                            @if ($emp->emp_status=='1')
                                            <input type="text" class="form-control" value="ปกติ" readonly>
                                            @endif
                                            @if ($emp->emp_status=='2')
                                            <input type="text" class="form-control" value="ทดลอง" readonly>
                                            @endif
                                            @if ($emp->emp_status=='0')
                                            <input type="text" class="form-control" value="ลาออก" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">เบอร์สำนักงาน</label>
                                            <input type="text" class="form-control" value="{{ $emp->tel }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">วันที่เข้าทำงาน</label>
                                            <input type="text" class="form-control"
                                                value="{{\Carbon\Carbon::parse($emp->start_work_date)->format('d/m/Y')}}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-office-building me-1"></i>
                                    ข้อมูลบริษัท</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ชื่อบริษัท</label>
                                            <input type="text" class="form-control" value="บริษัท อี.แอนด์ วี. จำกัด"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">เว็บไซต์</label>
                                            <input type="text" class="form-control" value="https://www.kaceenext.com/"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ที่อยู่บริษัท</label>
                                            <textarea class="form-control" rows="3"
                                                readonly>สาขาสำนักงานใหญ่&#13;&#10;259 ถนนเลียบคลองภาษีเจริญฝั่งใต้ แขวงหนองแขม เขตหนองแขม กรุงเทพมหานคร 10160</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="personal">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                    ข้อมูลส่วนตัว</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ชื่อ ภาษาไทย</label>
                                            <input type="text" class="form-control" value="{{ $emp->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">นามสกุล ภาษาไทย</label>
                                            <input type="text" class="form-control" value="{{ $emp->surname }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ชื่อเล่น</label>
                                            <input type="text" class="form-control" value="{{ $emp->nickname }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">เพศ</label>
                                            <input type="text" class="form-control"
                                                value="{{ ($emp->gender=='M') ? 'ชาย' : 'หญิง' }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ชื่อ ภาษาอังกฤษ</label>
                                            <input type="text" class="form-control" value="{{ $emp->name_en }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">นามสกุล ภาษาอังกฤษ</label>
                                            <input type="text" class="form-control" value="{{ $emp->surname_en }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">วัน/เดือน/ปีเกิด</label>
                                            <input type="text" class="form-control"
                                                value="{{\Carbon\Carbon::parse($emp->birth_date)->format('d/m/Y')}}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">เชื้อชาติ</label>
                                            <input type="text" class="form-control" value="{{ $emp->ethnicity }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">สัญชาติ</label>
                                            <input type="text" class="form-control" value="{{ $emp->nationality }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ศาสนา</label>
                                            <input type="text" class="form-control" value="{{ $emp->religion }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">เบอร์มือถือ</label>
                                            <input type="text" class="form-control" value="{{ $emp->phone }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">อีเมล</label>
                                            <input type="text" class="form-control" value="{{ $emp->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ทะเบียนรถ</label>
                                            <input type="text" class="form-control"
                                                value="{{ $emp->vehicle_registration }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-home-circle me-1"></i> ข้อมูลที่อยู่
                                </h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ที่อยู่</label>
                                            <textarea class="form-control" rows="3"
                                                readonly>{{ $emp->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ตำบล/แขวง</label>
                                            <input type="text" class="form-control" value="{{ $emp->subdistrict }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">อำเภอ/เขต</label>
                                            <input type="text" class="form-control" value="{{ $emp->district }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">จังหวัด</label>
                                            <input type="text" class="form-control" value="{{ $emp->province }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">รหัสไปรษณีย์</label>
                                            <input type="text" class="form-control" value="{{ $emp->zipcode }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane @if (!blank($errors)) show active @endif" id="settings">
                                <form name="password-form" method="POST" action="{{ route('profile.change.password') }}" onsubmit="return SubmitForm(this);">
                                    {{ csrf_field() }}
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-key me-1"></i>
                                        เปลี่ยนรหัสผ่าน</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">รหัสผ่านปัจจุบัน</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password"
                                                        class="form-control @error('current_password') is-invalid @enderror"
                                                        id="current_password" name="current_password"
                                                        placeholder="Current Password" autocomplete="off"
                                                        value="{{ old('current_password') }}" required>
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                    @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">รหัสผ่านใหม่</label>
                                                <span class="text-pink"> 8-12 หลัก ( a-z, A-Z, 0-9 ) อักขระพิเศษ ( @, #, -, _ )</span>
                                                <div class="input-group input-group-merge">
                                                    <input type="password"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        id="new_password" name="new_password" placeholder="New Password"
                                                        autocomplete="off" value="{{ old('new_password') }}" required>
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                    @error('new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">ยืนยัน รหัสผ่านใหม่</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password"
                                                        class="form-control @error('confirm_new_password') is-invalid @enderror"
                                                        id="confirm_new_password" name="confirm_new_password"
                                                        placeholder="Confirm New Password" autocomplete="off"
                                                        value="{{ old('confirm_new_password') }}" required>
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                    @error('confirm_new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <strong class="form-text confirm-message"></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> เปลี่ยนรหัสผ่าน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/ajax/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
            var success = "{{ session('success') ? session('success') : '' }}";
            if (success == 'password_changed') {
                Swal.fire({
                    icon: "success",
                    title: "เปลี่ยนรหัสผ่านเรียบร้อย! กรุณาเข้าสู่ระบบด้วยรหัสผ่านใหม่",
                    showConfirmButton: false,
                    timer: 3000,
                }).then(function() {
                    document.getElementById('logout-form').submit();
                });
            }
            $('#new_password, #confirm_new_password').on('keyup', function() {
                $('.confirm-message').text('').removeClass('text-success').removeClass('text-danger');
                let password=$('#new_password').val();
                let confirm_password=$('#confirm_new_password').val();
                if (password != "" && confirm_password != "") {
                    if(confirm_password===password){
                        $('.confirm-message').text('รหัสผ่านตรงกันแล้ว!').addClass('text-success');
                    }else{
                        $('.confirm-message').text("รหัสผ่านไม่ตรงกัน").addClass('text-danger');
                    }
                }
            });
        });
        function SubmitForm(form){
            var error = 0;
            let password=$('#new_password').val();
            if (password.search(/^[a-zA-Z0-9-@#_]+$/) == -1) {
                var msg = "รหัสผ่าน 8-12 หลัก ใช้ได้เฉพาะตัวเลข 0-9 ตัวอักษร a-z, A-Z, และอักขระพิเศษเฉพาะ @ # _ และ (-) ขีด เท่านั้น และห้ามมี 'ค่าว่าง' !";
                Swal.fire({
                    icon: "warning",
                    title: "โปรดโปรดตรวจสอบข้อมูลให้ถูกต้อง",
                    html: '<span class="text-danger">'+msg+'</span>',
                    timer: 3000,
                    showConfirmButton: false,
                });
                error++;
            }
            if (error > 0) {
                return false;
            }
        }
</script>
@endsection