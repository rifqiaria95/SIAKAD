<body class="">
    <div class="page-container">
        <div class="page-sidebar">
            <a class="logo" href="/">Tupan</a>
            <ul class="list-unstyled accordion-menu">
                <li class="{{ Request::is('dashboard')?'active-page open':'' }}">
                    <a href="/dashboard" class="dashboard"><i data-feather="activity"></i>Dashboard</a>
                </li>
                @if(auth()->user()->role == 'admin')
                <li class="{{ Request::is('user')?'active-page open':'' }}">
                  <a href="#"><i data-feather="user"></i>User<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li ><a href="/user" class="{{ Request::is('user')?'active':'' }}"><i class="far fa-circle"></i>Semua User</a></li>
                  </ul>
                </li>
                <li class="{{ Request::is('siswa', 'guru', 'mapel', 'kelas', 'jurusan')?'active-page open':'' }}">
                  <a href="#"><i data-feather="box"></i>Master Data<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li ><a href="/siswa" class="{{ Request::is('siswa')?'active':'' }}"><i class="far fa-circle"></i>Siswa</a></li>
                    <li ><a href="/guru" class="{{ Request::is('guru')?'active':'' }}"><i class="far fa-circle"></i>Guru</a></li>
                    <li ><a href="/kelas" class="{{ Request::is('kelas')?'active':'' }}"><i class="far fa-circle"></i>Kelas</a></li>
                    <li ><a href="/jurusan" class="{{ Request::is('jurusan')?'active':'' }}"><i class="far fa-circle"></i>Jurusan</a></li>
                    <li ><a href="/mapel" class="{{ Request::is('mapel')?'active':'' }}"><i class="far fa-circle"></i>Mata Pelajaran</a></li>
                    <li ><a href="#" class="{{ Request::is('jadwal')?'active':'' }}"><i class="far fa-circle"></i>Jadwal</a></li>
                  </ul>
                </li>
                <li class="{{ Request::is('absenguru', 'absensiswa')?'active-page open':'' }}">
                  <a href="#"><i data-feather="hard-drive"></i>Absensi<i class="fas fa-chevron-right dropdown-icon"></i></a>
                  <ul class="">
                    <li><a href="#" class="{{ Request::is('absenguru')?'active':'' }}"><i class="far fa-circle"></i>Absensi Guru</a></li>
                    <li><a href="#" class="{{ Request::is('absensiswa')?'active':'' }}"><i class="far fa-circle"></i>Absensi Siswa</a></li>
                  </ul>
                </li>
                <li class="{{ Request::is('rapor')?'active-page open':'' }}"><a href="#"><i data-feather="book"></i>Rapor Siswa</a></li>
                <li class="{{ Request::is('posts')?'active-page open':'' }}"><a href="/posts"><i data-feather="edit-2"></i>News</a></li>
                @endif
            </ul>
            <a href="#" id="sidebar-collapsed-toggle"><i data-feather="arrow-right"></i></a>
        </div>
        <div class="page-content">
            <div class="page-header">
                <nav class="navbar navbar-expand-lg d-flex justify-content-between">
                    <div class="header-title flex-fill">
                        <a href="#" id="sidebar-toggle"><i data-feather="arrow-left"></i></a>
                        <h5>SMK Ti Tunas Harapan Bekasi</h5>
                    </div>
                    <div class="header-search">
                    <form>
                        <input class="form-control" type="text" placeholder="Type something.." aria-label="Search">
                        <a href="#" class="close-search"><i data-feather="x"></i></a>
                    </form>
                    </div>
                    <div class="flex-fill" id="headerNav">
                        <ul class="navbar-nav">
                            <li class="nav-item d-md-block d-lg-none">
                            <a class="nav-link" href="#" id="toggle-search"><i data-feather="search"></i></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link activity-trigger" href="#" id="activity-sidebar-toggle"><i data-feather="grid"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link notifications-dropdown" href="#" id="notificationsDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">3<div class="spinner-grow text-danger" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div></a>
                            <div class="dropdown-menu dropdown-menu-end notif-drop-menu" aria-labelledby="notificationsDropDown">
                                <h6 class="dropdown-header">Notifications</h6>
                                <a href="#">
                                <div class="header-notif">
                                    <div class="notif-image">
                                    <span class="notification-badge bg-info text-white">
                                        <i class="fas fa-bullhorn"></i>
                                    </span>
                                    </div>
                                    <div class="notif-text">
                                    <p class="bold-notif-text">faucibus dolor in commodo lectus mattis</p>
                                    <small>19:00</small>
                                    </div>
                                </div>
                                </a>
                                <a href="#">
                                <div class="header-notif">
                                    <div class="notif-image">
                                    <span class="notification-badge bg-primary text-white">
                                        <i class="fas fa-bolt"></i>
                                    </span>
                                    </div>
                                    <div class="notif-text">
                                    <p class="bold-notif-text">faucibus dolor in commodo lectus mattis</p>
                                    <small>18:00</small>
                                    </div>
                                </div>
                                </a>
                                <a href="#">
                                <div class="header-notif">
                                    <div class="notif-image">
                                    <span class="notification-badge bg-success text-white">
                                        <i class="fas fa-at"></i>
                                    </span>
                                    </div>
                                    <div class="notif-text">
                                    <p>faucibus dolor in commodo lectus mattis</p>
                                    <small>yesterday</small>
                                    </div>
                                </div>
                                </a>
                                <a href="#">
                                <div class="header-notif">
                                    <div class="notif-image">
                                    <span class="notification-badge">
                                        <img src="" alt="">
                                    </span>
                                    </div>
                                    <div class="notif-text">
                                    <p>faucibus dolor in commodo lectus mattis</p>
                                    <small>yesterday</small>
                                    </div>
                                </div>
                                </a>
                                <a href="#">
                                    <div class="header-notif">
                                        <div class="notif-image">
                                            <span class="notification-badge">
                                                <img src="" alt="">
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p>faucibus dolor in commodo lectus mattis</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="
                                @if(auth()->user()->role == 'siswa')
                                    {{auth()->user()->siswa->getAvatar()}}
                                @else
                                    {{ asset('template/images/avatars/profile-image.jpg') }}
                                @endif" alt=""></a>
                                <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                                    <a class="dropdown-item" href="/profilsaya"><i data-feather="user"></i>{{ Auth::user()->name }}</a>
                                    <a class="dropdown-item" href="#"><i data-feather="unlock"></i>Anda login sebagai {{ Auth::user()->role }}</a>
                                    <!-- <a class="dropdown-item" href="#"><i data-feather="inbox"></i>Messages</a>
                                    <a class="dropdown-item" href="#"><i data-feather="edit"></i>Activities<span class="badge rounded-pill bg-success">12</span></a>
                                    <a class="dropdown-item" href="#"><i data-feather="check-circle"></i>Tasks</a> -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i data-feather="settings"></i>Settings</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>