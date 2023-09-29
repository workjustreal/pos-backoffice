<div class="navbar-custom bg-gradient">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @if (auth()->check())
                        <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-image"
                            class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ auth()->user()->name . ' ' . auth()->user()->surname }} <i
                                class="mdi mdi-chevron-down"></i>
                        </span>
                    @else
                        <img src="{{ url('assets/images/users/user-1.jpg') }}" alt="user-image" class="rounded-circle">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    @if (Session::has('token'))
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                    @endif
                    <a href="{{ route('kaceecenter') }}" class="dropdown-item notify-item">
                        <i class="fe-home" title="KACEE CENTER"></i>
                        <span>กลับสู่เว็บไซต์หลัก</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item" data-bs-toggle="modal"
                        data-bs-target="#helpModal">
                        <i class="fe-headphones" title="HELP & SUPPORT"></i>
                        <span>ช่วยเหลือ</span>
                    </a>
                    @if (Session::has('token'))
                        <div class="dropdown-divider"></div>
                        <a href=""
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="dropdown-item notify-item">
                            <i class="fe-log-out" title="LOGOUT"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
            </li>
        </ul>

        <div class="logo-box">
            <a href="{{ route('home') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" id="logo"
                        class="h24">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('assets/images/logo.png') }}" alt="" id="logo" class="h40">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h4 class="modal-title" id="helpModalLabel"><i class="fe-phone-call"></i> ต่อต่อ</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-start mb-3 mt-1 border-bottom border-light">
                            <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/users/user-1.jpg') }}"
                                alt="placeholder image" height="32">
                            <div class="w-100">
                                <h6 class="font-14">7887 <small class="text-muted">(เอ็ม) โปรแกรมเมอร์</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-start mb-3 mt-1 border-bottom border-light">
                            <img class="d-flex me-2 rounded-circle" src="{{ asset('assets/images/users/user-1.jpg') }}"
                                alt="placeholder image" height="32">
                            <div class="w-100">
                                <h6 class="font-14">7884 <small class="text-muted">(ฮิม)
                                        ผู้จัดการฝ่ายโปรแกรมเมอร์</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-start mb-3 mt-1 border-bottom border-light">
                            <img class="d-flex me-2 rounded-circle"
                                src="{{ asset('assets/images/users/user-1.jpg') }}" alt="placeholder image"
                                height="32">
                            <div class="w-100">
                                <h6 class="font-14">7880 <small class="text-muted">(ปุ๊ก)
                                        ผู้จัดการฝ่ายไอทีและโปรแกรมเมอร์</small></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
