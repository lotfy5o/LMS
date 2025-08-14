<div class="sidebar-wrapper" data-simplebar="true">
    @php
        $id = Auth::user()->id;
        $instructorId = App\Models\User::find($id);
        $status = $instructorId->status;
    @endphp

    <div class="sidebar-header">
        <div>
            <img src="{{ asset('asset-back') }}/images/logo-icon.png" class="logo-icon"
                alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('instructor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="app-emailbox.html"><i class='bx bx-radio-circle'></i>Email</a>
                </li>
                <li> <a href="app-chat-box.html"><i class='bx bx-radio-circle'></i>Chat Box</a>
                </li>
                <li> <a href="app-file-manager.html"><i class='bx bx-radio-circle'></i>File
                        Manager</a>
                </li>
                <li> <a href="app-contact-list.html"><i class='bx bx-radio-circle'></i>Contatcs</a>
                </li>
                <li> <a href="app-to-do.html"><i class='bx bx-radio-circle'></i>Todo List</a>
                </li>
                <li> <a href="app-invoice.html"><i class='bx bx-radio-circle'></i>Invoice</a>
                </li>
                <li> <a href="app-fullcalender.html"><i class='bx bx-radio-circle'></i>Calendar</a>
                </li>
            </ul>
        </li>

        @if ($status == 1)
            <li class="menu-label">Manage Courses</li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage Courses</div>
                </a>
                <ul>
                    <li> <a href="{{ route('courses.index') }}"><i
                                class='bx bx-radio-circle'></i>Courses</a>
                    </li>
                    <li> <a href="ecommerce-products-details.html"><i
                                class='bx bx-radio-circle'></i>Product
                            Details</a>
                    </li>
                    <li> <a href="ecommerce-add-new-products.html"><i
                                class='bx bx-radio-circle'></i>Add New
                            Products</a>
                    </li>
                    <li> <a href="ecommerce-orders.html"><i
                                class='bx bx-radio-circle'></i>Orders</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Manage Orders</div>
                </a>
                <ul>
                    <li> <a href="{{ route('instructor.orders.index') }}"><i
                                class='bx bx-radio-circle'></i>All
                            Orders</a>
                    </li>
                </ul>
            </li>


            <li class="menu-label">Pages</li>

            <li class="menu-label">Charts & Maps</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-line-chart"></i>
                    </div>
                    <div class="menu-title">Charts</div>
                </a>
                <ul>
                    <li> <a href="charts-apex-chart.html"><i class='bx bx-radio-circle'></i>Apex</a>
                    </li>
                    <li> <a href="charts-chartjs.html"><i class='bx bx-radio-circle'></i>Chartjs</a>
                    </li>
                    <li> <a href="charts-highcharts.html"><i
                                class='bx bx-radio-circle'></i>Highcharts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-map-alt"></i>
                    </div>
                    <div class="menu-title">Maps</div>
                </a>
                <ul>
                    <li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google
                            Maps</a>
                    </li>
                    <li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector
                            Maps</a>
                    </li>
                </ul>
            </li>
        @else
        @endif

        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
