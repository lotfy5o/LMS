<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('asset-back')}}/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
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
                <li> <a href="app-file-manager.html"><i class='bx bx-radio-circle'></i>File Manager</a>
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
        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Manage Categories</div>
            </a>
            <ul>
                <li> <a href="{{ route('back.categories.index') }}"><i class='bx bx-radio-circle'></i>Categories</a>
                </li>
                <li> <a href="{{ route('back.SubCategories.index') }}"><i
                            class='bx bx-radio-circle'></i>SubCategories</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Manage Instructors</div>
            </a>
            <ul>
                <li> <a href="{{ route('back.teachers.index') }}"><i class='bx bx-radio-circle'></i>Instructors</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Components</div>
            </a>
            <ul>
                <li> <a href="component-alerts.html"><i class='bx bx-radio-circle'></i>Alerts</a>
                </li>
                <li> <a href="component-accordions.html"><i class='bx bx-radio-circle'></i>Accordions</a>
                </li>
                <li> <a href="component-badges.html"><i class='bx bx-radio-circle'></i>Badges</a>
                </li>
                <li> <a href="component-buttons.html"><i class='bx bx-radio-circle'></i>Buttons</a>
                </li>
                <li> <a href="component-cards.html"><i class='bx bx-radio-circle'></i>Cards</a>
                </li>
                <li> <a href="component-carousels.html"><i class='bx bx-radio-circle'></i>Carousels</a>
                </li>
                <li> <a href="component-list-groups.html"><i class='bx bx-radio-circle'></i>List Groups</a>
                </li>
                <li> <a href="component-media-object.html"><i class='bx bx-radio-circle'></i>Media Objects</a>
                </li>
                <li> <a href="component-modals.html"><i class='bx bx-radio-circle'></i>Modals</a>
                </li>
                <li> <a href="component-navs-tabs.html"><i class='bx bx-radio-circle'></i>Navs & Tabs</a>
                </li>
                <li> <a href="component-navbar.html"><i class='bx bx-radio-circle'></i>Navbar</a>
                </li>
                <li> <a href="component-paginations.html"><i class='bx bx-radio-circle'></i>Pagination</a>
                </li>
                <li> <a href="component-popovers-tooltips.html"><i class='bx bx-radio-circle'></i>Popovers &
                        Tooltips</a>
                </li>
                <li> <a href="component-progress-bars.html"><i class='bx bx-radio-circle'></i>Progress</a>
                </li>
                <li> <a href="component-spinners.html"><i class='bx bx-radio-circle'></i>Spinners</a>
                </li>
                <li> <a href="component-notifications.html"><i class='bx bx-radio-circle'></i>Notifications</a>
                </li>
                <li> <a href="component-avtars-chips.html"><i class='bx bx-radio-circle'></i>Avatrs & Chips</a>
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
                <li> <a href="charts-highcharts.html"><i class='bx bx-radio-circle'></i>Highcharts</a>
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
                <li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a>
                </li>
            </ul>
        </li>

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
