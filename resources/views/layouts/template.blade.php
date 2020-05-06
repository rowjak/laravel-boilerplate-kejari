
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Blank Page - AppStack - Admin &amp; Dashboard Template</title>

	<link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
	<link href="{{asset('')}}back/css/classic.css" rel="stylesheet">

</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content ">
				<a class="sidebar-brand" href="{{route('dashboard')}}">
                    <i class="align-middle" data-feather="box"></i>
                    <span class="align-middle">Kejari Batang</span>
                </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Menu Utama
                    </li>
                    <li class="sidebar-item @if(request()->is('dashboard')) active @endif">
						<a class="sidebar-link" href="{{route('dashboard')}}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>
                    <li class="sidebar-item @if(request()->is('sidang*')) active @endif">
						<a class="sidebar-link" href="{{route('sidang.index')}}">
                            <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Data Sidang</span>
                        </a>
                    </li>
                    <li class="sidebar-item @if(request()->is('tempat*')) active @endif">
						<a class="sidebar-link" href="{{route('tempat.index')}}">
                            <i class="align-middle" data-feather="compass"></i> <span class="align-middle">Data Tempat</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item @if(request()->is('laporan*')) active @endif">
						<a class="sidebar-link" href="calendar.html">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Laporan</span>
                        </a>
                    </li> --}}
                    <li class="sidebar-header">
						Utilitas
                    </li>
                    <li class="sidebar-item @if(request()->is('carousel*')) active @endif">
						<a class="sidebar-link" href="{{route('carousel.index')}}">
                            <i class="align-middle" data-feather="image"></i> <span class="align-middle">Carousel</span>
                        </a>
					</li>
                    <li class="sidebar-item @if(request()->is('runningtext*')) active @endif">
						<a class="sidebar-link" href="{{route('runningtext.index')}}">
                            <i class="align-middle" data-feather="type"></i> <span class="align-middle">Running Text</span>
                        </a>
                    </li>
                    <hr>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{route('runningtext.index')}}">
                            <i class="align-middle" data-feather="corner-down-left"></i> <span class="align-middle">Log Out</span>
                        </a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light bg-white">
				<a class="sidebar-toggle d-flex mr-2">
                    <i class="hamburger align-self-center"></i>
                </a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                <img src="{{asset('logo.png')}}" class="avatar img-fluid rounded-circle mr-1" alt="Kejaksaan Negeri Kab. Batang"> <span class="text-dark">{{Auth::user()->name}}</span>
                            </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pages-settings.html">Settings & Privacy</a>
								<a class="dropdown-item" href="#">Help</a>
								<a class="dropdown-item" href="#">Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				@yield('content')
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							{{-- Develop By Abdur Rozaq, 085741880658 --}}
						</div>
						<div class="col-6 text-right">
							<p class="mb-0">
								&copy; 2020 - <a href="index.html" class="text-muted">Pemerintah Kabupaten Batang</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

    <script src="{{asset('')}}back/js\app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(function(e){
            $('.select2').select2()
        })
    </script>

    @yield('script')

</body>

</html>
