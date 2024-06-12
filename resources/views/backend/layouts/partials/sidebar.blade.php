@php $user = Auth::user(); @endphp

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">
                        {{ $user->first_name }}
                        <span class="badge badge-info">{{ $user->language ? $user->language->name : '' }}</span>
                    </span>
                </li>

                @if ($user->can('dashboard.view'))
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.index') }}"
                            aria-expanded="false">
                            <i class="mdi mdi-creation"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                @endcan

                @if ($user->can('admin.view') || $user->can('admin.create') || $user->can('role.view') || $user->can('role.create'))
                    <li class="sidebar-item ">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-account"></i>
                            <span class="hide-menu">Tài khoản & Quyền </span>
                        </a>
                        <ul aria-expanded="false"
                            class="collapse first-level {{ Route::is('admin.admins.index') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') ? 'in' : null }}">
                            @if ($user->can('admin.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.admins.index') }}"
                                        class="sidebar-link {{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : null }}">
                                        <i class="mdi mdi-view-list"></i>
                                        <span class="hide-menu"> Danh sách tài khoản </span>
                                    </a>
                                </li>
                            @endcan

                            @if ($user->can('admin.create'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.admins.create') }}"
                                        class="sidebar-link {{ Route::is('admin.admins.create') ? 'active' : null }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        <span class="hide-menu"> Thêm tài khoản </span>
                                    </a>
                                </li>
                            @endcan

                            @if ($user->can('role.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="sidebar-link {{ Route::is('admin.roles.index') ? 'active' : null }}">
                                        <i class="mdi mdi-view-quilt"></i>
                                        <span class="hide-menu"> Quyền </span>
                                    </a>
                                </li>
                            @endcan

                            @if ($user->can('role.create'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.roles.create') }}"
                                        class="sidebar-link {{ Route::is('admin.roles.create') ? 'active' : null }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        <span class="hide-menu"> Thêm quyền </span>
                                    </a>
                                </li>
                            @endcan
        </ul>
    </li>
@endcan

{{-- @if ($user->can('category.view') || $user->can('category.create'))
                <li class="sidebar-item ">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-tune"></i>
                        <span class="hide-menu">Categories </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.categories.index') || Route::is('admin.categories.create') || Route::is('admin.categories.edit')) ? 'in' : null }}">
                        @if ($user->can('category.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ (Route::is('admin.categories.index') || Route::is('admin.categories.edit')) ? 'active' : null }}">
                                <i class="mdi mdi-view-list"></i>
                                <span class="hide-menu"> Category List </span>
                            </a>
                        </li>
                        @endif

                        @if ($user->can('category.create'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.categories.create') }}" class="sidebar-link {{ Route::is('admin.categories.create') ? 'active' : null }}">
                                <i class="mdi mdi-plus-circle"></i>
                                <span class="hide-menu"> New Category </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif --}}

{{-- @if ($user->can('page.view') || $user->can('page.create'))
                <li class="sidebar-item ">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-tag-text-outline"></i>
                        <span class="hide-menu">Article/Pages </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.pages.index') || Route::is('admin.pages.create') || Route::is('admin.pages.edit')) ? 'in' : null }}">
                        @if ($user->can('page.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ (Route::is('admin.pages.index') || Route::is('admin.pages.edit')) ? 'active' : null }}">
                                <i class="mdi mdi-view-list"></i>
                                <span class="hide-menu"> Article/Page List </span>
                            </a>
                        </li>
                        @endif

                        @if ($user->can('page.create'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.pages.create') }}" class="sidebar-link {{ Route::is('admin.pages.create') ? 'active' : null }}">
                                <i class="mdi mdi-plus-circle"></i>
                                <span class="hide-menu"> New Article/Page </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif --}}

{{-- @if ($user->can('service.view') || $user->can('service.create'))
                <li class="sidebar-item ">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-arrow-right-drop-circle"></i>
                        <span class="hide-menu">Services </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.services.index') || Route::is('admin.services.create') || Route::is('admin.services.edit')) ? 'in' : null }}">
                        @if ($user->can('service.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ (Route::is('admin.services.index') || Route::is('admin.services.edit')) ? 'active' : null }}">
                                <i class="mdi mdi-view-list"></i>
                                <span class="hide-menu"> Service List </span>
                            </a>
                        </li>
                        @endif

                        @if ($user->can('service.create'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.services.create') }}" class="sidebar-link {{ Route::is('admin.services.create') ? 'active' : null }}">
                                <i class="mdi mdi-plus-circle"></i>
                                <span class="hide-menu"> New Service </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif --}}

{{-- @if ($user->can('booking_request.view') || $user->can('booking_request.edit') || $user->can('booking_request.delete'))
                @php
                    $count_pending_booking_request = \Modules\Booking\Entities\BookingRequest::where('status', 'pending')->count();
                @endphp
                <li class="sidebar-item ">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-application"></i>
                        <span class="hide-menu">Booking Requests </span>
                        {{ " " }}<span class="badge badge-warning">{{ $count_pending_booking_request }}</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.booking_request.index') || Route::is('admin.booking_request.create') || Route::is('admin.booking_request.edit')) ? 'in' : null }}">
                        @if ($user->can('booking_request.view'))
                        <li class="sidebar-item">
                            <a href="{{ route('admin.booking_request.index') }}" class="sidebar-link {{ (Route::is('admin.booking_request.index') || Route::is('admin.booking_request.edit')) ? 'active' : null }}">
                                <i class="mdi mdi-view-list"></i>
                                <span class="hide-menu"> Request List <span class="badge badge-warning">{{ $count_pending_booking_request }}</span> </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif --}}

{{-- @if ($user->can('blog.view') || $user->can('blog.create'))
                    <li class="sidebar-item ">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-view-list"></i>
                            <span class="hide-menu">Blogs </span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.blogs.index') || Route::is('admin.blogs.create') || Route::is('admin.blogs.edit')) ? 'in' : null }}">
                            @if ($user->can('blog.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ (Route::is('admin.blogs.index') || Route::is('admin.blogs.edit')) ? 'active' : null }}">
                                        <i class="mdi mdi-view-list"></i>
                                        <span class="hide-menu"> Blog List </span>
                                    </a>
                                </li>
                            @endif

                            @if ($user->can('blog.create'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.blogs.create') }}" class="sidebar-link {{ Route::is('admin.blogs.create') ? 'active' : null }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        <span class="hide-menu"> New Blog </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}

@if ($user->can('exam.view') || $user->can('exam.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Thi trắc nghiệm </span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.exams.index') || Route::is('admin.exams.create') || Route::is('admin.exams.edit') ? 'in' : null }}">
            @if ($user->can('exam.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.exams.index') }}"
                        class="sidebar-link {{ Route::is('admin.exams.index') || Route::is('admin.exams.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách kiểm tra </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.exams.audit') }}"
                        class="sidebar-link {{ Route::is('admin.exams.audit') || Route::is('admin.exams.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Kiểm tra công nhân mới</span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($user->can('checkCutMachine.view') || $user->can('checkCutMachine.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Check list hàng ngày máy cắt</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.checkCutMachine.index') || Route::is('admin.checkCutMachine.create') || Route::is('admin.checkCutMachine.edit') ? 'in' : null }}">
            @if ($user->can('checkCutMachine.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.checkCutMachine.index') }}"
                        class="sidebar-link {{ Route::is('admin.checkCutMachine.index') || Route::is('admin.checkCutMachine.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách check list </span>
                    </a>
                </li>
            @endif

            @if ($user->can('checkCutMachine.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.checkCutMachine.create') }}"
                        class="sidebar-link {{ Route::is('admin.checkCutMachine.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu"> Thêm check list</span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($user->can('productvt.view') || $user->can('productvt.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Sản lượng </span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.productvt.index') || Route::is('admin.productvt.create') || Route::is('admin.productvt.edit') ? 'in' : null }}">
            {{-- @if ($user->can('productvt.view')) --}}
            <li class="sidebar-item">
                {{-- <a href="{{ route('admin.productvt.index') }}" class="sidebar-link {{ (Route::is('admin.productvt.index') || Route::is('admin.productvt.edit')) ? 'active' : null }}"> --}}
                <a class="sidebar-link" href="{{ url('admin/productvt') }}">
                    <i class="mdi mdi-view-list"></i>
                    <span class="hide-menu"> Danh sách </span>
                </a>
            </li>
            {{-- @endif --}}
        </ul>
    </li>
@endif


{{-- 張力を確認してください
                Kiểm tra sức căng
                Check Tension --}}
{{-- @if ($user->can('checkTension.view') || $user->can('checkTension.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Kiểm tra sức căng</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.checkTension.index') || Route::is('admin.checkTension.create') || Route::is('admin.checkTension.edit') ? 'in' : null }}">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('admin/checkTension') }}">
                    <i class="mdi mdi-view-list"></i>
                    <span class="hide-menu"> Nhập dữ liệu </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('admin/checkTension/view') }}">
                    <i class="mdi mdi-view-list"></i>
                    <span class="hide-menu"> Xem dữ liệu </span>
                </a>
            </li>
        </ul>
    </li>
@endif --}}
{{-- @if ($user->can('contact.view') || $user->can('contact.create'))
                    <li class="sidebar-item ">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-email"></i>
                            <span class="hide-menu">Contact Message </span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.contacts.index') || Route::is('admin.contacts.show')) ? 'in' : null }}">
                            @if ($user->can('contact.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ (Route::is('admin.contacts.index') || Route::is('admin.contacts.show')) ? 'active' : null }}">
                                        <i class="mdi mdi-email"></i>
                                        <span class="hide-menu"> Message List </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}

{{-- <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Extra</span>
                </li> --}}

@if ($user->can('department.view') || $user->can('department.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Bộ phận</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.departments.index') || Route::is('admin.departments.create') || Route::is('admin.departments.edit') ? 'in' : null }}">
            @if ($user->can('department.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.departments.index') }}"
                        class="sidebar-link {{ Route::is('admin.departments.index') || Route::is('admin.departments.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif

            @if ($user->can('department.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.departments.create') }}"
                        class="sidebar-link {{ Route::is('admin.departments.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu"> Thêm mới </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($user->can('asset.view') || $user->can('asset.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Tài sản</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.assets.index') || Route::is('admin.assets.create') || Route::is('admin.assets.edit') ? 'in' : null }}">
            @if ($user->can('asset.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.assets.index') }}"
                        class="sidebar-link {{ Route::is('admin.assets.index') || Route::is('admin.assets.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif

            @if ($user->can('asset.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.assets.create') }}"
                        class="sidebar-link {{ Route::is('admin.assets.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu"> Thêm mới </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif



{{-- @if ($user->can('campaign.view') || $user->can('campaign.create'))
                    <li class="sidebar-item ">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-view-list"></i>
                            <span class="hide-menu">Lịch sử thao tác</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.campaigns.index') || Route::is('admin.campaigns.create') || Route::is('admin.campaigns.edit')) ? 'in' : null }}">
                            @if ($user->can('campaign.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.campaigns.index') }}" class="sidebar-link {{ (Route::is('admin.campaigns.index') || Route::is('admin.campaigns.edit')) ? 'active' : null }}">
                                        <i class="mdi mdi-view-list"></i>
                                        <span class="hide-menu"> Danh sách </span>
                                    </a>
                                </li>
                            @endif

                            @if ($user->can('campaign.create'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.campaigns.create') }}" class="sidebar-link {{ Route::is('admin.campaigns.create') ? 'active' : null }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        <span class="hide-menu"> Cấu hình </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($user->can('campaign_detail.view') || $user->can('campaign_detail.create'))
                    <li class="sidebar-item ">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-view-list"></i>
                            <span class="hide-menu">Lịch sử thao tác</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.campaign_detail.index') || Route::is('admin.campaign_detail.create') || Route::is('admin.campaign_detail.edit')) ? 'in' : null }}">
                            @if ($user->can('campaign_detail.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.campaign_detail.index') }}" class="sidebar-link {{ (Route::is('admin.campaign_detail.index') || Route::is('admin.campaign_detail.edit')) ? 'active' : null }}">
                                        <i class="mdi mdi-view-list"></i>
                                        <span class="hide-menu"> Danh sách </span>
                                    </a>
                                </li>
                            @endif

                            @if ($user->can('campaign_detail.create'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.campaign_detail.create') }}" class="sidebar-link {{ Route::is('admin.campaign_detail.create') ? 'active' : null }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        <span class="hide-menu"> Cấu hình </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}

{{-- @if ($user->can('comment.view') || $user->can('comment.create'))
                    <li class="sidebar-item ">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-view-list"></i>
                            <span class="hide-menu">Lịch sử thao tác</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level {{ (Route::is('admin.comments.index') || Route::is('admin.comments.create') || Route::is('admin.comments.edit')) ? 'in' : null }}">
                            @if ($user->can('comment.view'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.comments.index') }}" class="sidebar-link {{ (Route::is('admin.comments.index') || Route::is('admin.comments.edit')) ? 'active' : null }}">
                                        <i class="mdi mdi-view-list"></i>
                                        <span class="hide-menu"> Danh sách </span>
                                    </a>
                                </li>
                            @endif

                            @if ($user->can('comment.create'))
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.comments.create') }}" class="sidebar-link {{ Route::is('admin.comments.create') ? 'active' : null }}">
                                        <i class="mdi mdi-plus-circle"></i>
                                        <span class="hide-menu"> Cấu hình </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}

@if ($user->can('employee.view') || $user->can('employee.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Nhân viên</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.employees.index') || Route::is('admin.employees.create') || Route::is('admin.employees.edit') ? 'in' : null }}">
            @if ($user->can('employee.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.employees.index') }}"
                        class="sidebar-link {{ Route::is('admin.employees.index') || Route::is('admin.employees.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách nhân viên </span>
                    </a>
                </li>
            @endif

            @if ($user->can('employee.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.employees.create') }}"
                        class="sidebar-link {{ Route::is('admin.employees.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu"> Thêm nhân viên </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($user->can('accessory.view') || $user->can('accessory.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Linh kiện</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.accessorys.index') || Route::is('admin.accessorys.create') || Route::is('admin.accessorys.edit') ? 'in' : null }}">
            @if ($user->can('required.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.accessorys.index') }}"
                        class="sidebar-link {{ Route::is('admin.accessorys.index') || Route::is('admin.accessorys.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($user->can('required.view') || $user->can('required.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Yêu cầu linh kiện</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.requireds.index') || Route::is('admin.requireds.create') || Route::is('admin.requireds.edit') ? 'in' : null }}">
            @if ($user->can('required.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.requireds.index') }}"
                        class="sidebar-link {{ Route::is('admin.requireds.index') || Route::is('admin.requireds.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif

            @if ($user->can('required.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.requireds.create') }}"
                        class="sidebar-link {{ Route::is('admin.requireds.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu"> Thêm yêu cầu </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($user->can('warehouse.view') || $user->can('warehouse.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Xuất linh kiện</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.warehouses.index') || Route::is('admin.warehouses.create') || Route::is('admin.warehouses.edit') ? 'in' : null }}">
            @if ($user->can('warehouse.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.warehouses.index') }}"
                        class="sidebar-link {{ Route::is('admin.warehouses.index') || Route::is('admin.warehouses.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($user->can('checkdevice.view') || $user->can('checkdevice.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Kiểm tra thiết bị</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.checkdevices.index') || Route::is('admin.checkdevices.create') || Route::is('admin.checkdevices.edit') ? 'in' : null }}">
            @if ($user->can('checkdevice.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.checkdevices.index') }}"
                        class="sidebar-link {{ Route::is('admin.checkdevices.index') || Route::is('admin.checkdevices.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif

            @if ($user->can('checkdevice.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.checkdevices.create') }}"
                        class="sidebar-link {{ Route::is('admin.checkdevices.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu">Kiểm tra</span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if ($user->can('signature_submission.view') || $user->can('signature_submission.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Trình ký</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.signatureSubmissions.index') || Route::is('admin.signatureSubmissions.create') || Route::is('admin.signatureSubmissions.edit') ? 'in' : null }}">
            @if ($user->can('signature_submission.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.signatureSubmissions.index') }}"
                        class="sidebar-link {{ Route::is('admin.signatureSubmissions.index') || Route::is('admin.signatureSubmissions.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif

            @if ($user->can('signature_submission.create'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.signatureSubmissions.create') }}"
                        class="sidebar-link {{ Route::is('admin.signatureSubmissions.create') ? 'active' : null }}">
                        <i class="mdi mdi-plus-circle"></i>
                        <span class="hide-menu"> Thêm mới </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif

@if ($user->can('activity.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Lịch sử thao tác</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.activitys.index') || Route::is('admin.activitys.create') || Route::is('admin.activitys.edit') ? 'in' : null }}">
            <li class="sidebar-item">
                <a href="{{ route('admin.activitys.index') }}"
                    class="sidebar-link {{ Route::is('admin.activitys.index') || Route::is('admin.activitys.edit') ? 'active' : null }}">
                    <i class="mdi mdi-view-list"></i>
                    <span class="hide-menu"> Danh sách </span>
                </a>
            </li>
        </ul>
    </li>
@endif

@if ($user->can('log_import.view') || $user->can('log_import.create'))
    <li class="sidebar-item ">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
            aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Lịch sử Import</span>
        </a>
        <ul aria-expanded="false"
            class="collapse first-level {{ Route::is('admin.logImports.index') || Route::is('admin.logImports.create') || Route::is('admin.logImports.edit') ? 'in' : null }}">
            @if ($user->can('log_import.view'))
                <li class="sidebar-item">
                    <a href="{{ route('admin.logImports.index') }}"
                        class="sidebar-link {{ Route::is('admin.logImports.index') || Route::is('admin.logImports.edit') ? 'active' : null }}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="hide-menu"> Danh sách </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>
@endif
<li class="sidebar-item ">
    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
        aria-expanded="false">
        <i class="mdi mdi-settings"></i>
        <span class="hide-menu">Cấu hình hệ thống</span>
    </a>
    <ul aria-expanded="false"
        class="collapse first-level {{ Route::is('admin.languages.index') || Route::is('admin.languages.create') || Route::is('admin.languages.edit') || Route::is('admin.languages.connection.index') ? 'in' : null }}">
        <li class="sidebar-item">
            <a href="{{ route('admin.languages.index') }}"
                class="sidebar-link {{ Route::is('admin.languages.index') || Route::is('admin.languages.create') || Route::is('admin.languages.edit') ? 'active' : null }}">
                <i class="mdi mdi-plus-circle"></i>
                <span class="hide-menu"> Ngôn ngữ </span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.settings.index') }}"
                class="sidebar-link {{ Route::is('admin.settings.index') ? 'active' : null }}">
                <i class="mdi mdi-settings"></i>
                <span class="hide-menu"> Cài đặt </span>
            </a>
        </li>
    </ul>
</li>

<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link"
        href="{{ route('admin.logout') }}"
        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
        aria-expanded="false">
        <i class="mdi mdi-directions"></i>
        <span class="hide-menu">Đăng xuất</span>
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
        style="display: none;">
        @csrf
    </form>
</li>
</ul>
</nav>
<!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>
