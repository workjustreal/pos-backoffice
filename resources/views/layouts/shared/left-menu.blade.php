<!-- ========== Left Sidebar Start ========== -->
@php
$user_id = 0;
if (Session::has('user_id')) {
$user_id = session()->get('user_id');
}
@endphp
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                @if (Session::has('token'))
                <li class="menu-title">POS BACKEND</li>
                @if (Auth::User()->noProductPrice())
                <li class="@if (request()->segment(1) == 'home') menuitem-active @endif">
                    <a href="{{ url('/home') }}">
                        <i class="fe-airplay"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ url('pos/price') }}">
                        <i class="fe-box"></i>
                        <span>&nbsp;Product Price </span>
                    </a>
                </li>
                @if (Auth::User()->noProductPrice())
                <li class="@if (request()->segment(1) == 'user') menuitem-active @endif">
                    <a href="#sidebarorder" data-bs-toggle="collapse">
                        <i class="fas fa-list-alt"></i>
                        <span> Order </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse @if (request()->segment(1) == 'user') show @endif" id="sidebarorder">
                        <ul class="nav-second-level">
                            <li class="@if (request()->segment(2) == 'order-list' ||
                                        request()->segment(2) == 'register' ||
                                        request()->segment(2) == 'user-edit') menuitem-active @endif">
                                <a href="{{ url('admin/orderlist') }}">
                                    <i class="mdi mdi-clipboard-list-outline"></i>
                                    <span>&nbsp; รายการออเดอร์ </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/product-list') }}">
                                    <i class="fas fa-box-open"></i>
                                    <span>&nbsp; รายการสินค้า </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (Auth::User()->permission_admin())
                <li class="menu-title">ADMINISTRATOR</li>
                <li class="@if (request()->segment(1) == 'user') menuitem-active @endif">
                    <a href="#sidebarSetting" data-bs-toggle="collapse">
                        <i class="fe-settings"></i>
                        <span> System Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse @if (request()->segment(1) == 'user') show @endif" id="sidebarSetting">
                        <ul class="nav-second-level">
                            <li class="@if (request()->segment(2) == 'user-manage' ||
                                            request()->segment(2) == 'register' ||
                                            request()->segment(2) == 'user-edit') menuitem-active @endif">
                                <a href="#sidebarSetting-2" data-bs-toggle="collapse">
                                    <i class="mdi mdi-monitor"></i>&nbsp; เครื่อง POS <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse @if (request()->segment(2) == 'user-manage' ||
                                                request()->segment(2) == 'register' ||
                                                request()->segment(2) == 'user-edit') show @endif"
                                    id="sidebarSetting-2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ url('/admin/member-manage') }}" title="POS MANAGE">จัดการเครื่อง
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/pos-register') }}" title="POS Create">เพิ่มเครื่อง
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#sidebarSetting-3" data-bs-toggle="collapse">
                                    <i class="fas fa-store"></i>&nbsp; ร้านค้า <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSetting-3">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ url('/admin/shop-manage') }}" title="Shop MANAGE">จัดการร้านค้า
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/shop-create') }}" title="Shop Create">สร้างร้านค้า
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarlevel-4" data-bs-toggle="collapse">
                                    <i class="mdi mdi-shield-check"></i>&nbsp;Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarlevel-4">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="/admin/user-role">
                                                ผู้ใช้งาน </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/admin/user-role-add">
                                                เพิ่มสิทธิผู้ใช้งาน </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/admin/level">
                                                บทบาทการใช้งาน </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/admin/add-level">
                                                เพิ่มบทบาทการใช้งาน </span>
                                            </a>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>