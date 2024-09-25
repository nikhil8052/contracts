
<header class="site-header desktop_header">
	<div class="container">
		<div class="header-nav">
			<nav class="navbar navbar-expand-lg">
				<div class="col-md-3 brand-ord">
					<a class="navbar-brand img-fluid" href="{{ url('/') }} " aria-label="Read more about Seminole tax hike">
						<img src="https://documentos-legales.mx/wp-content/uploads/2023/08/logo-documentos-legales.svg" alt="header-logo" class="img-fluid" height="75" width="175" />
					</a>
				</div>

				<div class="col-md-9 header-nav-menu-cs">
					<button class="navbar-toggler btn-ord" aria-label="Name" type="button">
						<div class="bars bar1"></div>
						<div class="bars bar2"></div>
						<div class="bars bar3"></div>
					</button>
					<div id="navbarNavDropdown" class="collapse navbar-collapse">
						<ul id="menu-header-menu" class="navbar-nav ml-auto"><li id="menu-item-241" class=""><a href="" class="nav-link">Crear documento</a></li>
							<li id="menu-item-4317" class=""><a href="{{ url('/') }}" class="nav-link">Documentos legales</a></li>
							<li id="menu-item-423" class=""><a href="{{ url('/how-it-works') }}" class="nav-link">Así funciona</a></li>
							<li id="menu-item-2145" class=""><a href="javascript:void(0)" class="nav-link">Preguntas</a></li>
							<li id="custom-menu-item-200" class=""><a href="javascript:void(0)">|</a></li>
							@if(!auth()->user())
							<li class=""><a href="{{url('/login')}}" class="nav-link" aria-label="Read more about Seminole tax hike"><i class="fas fa-user"></i> <strong class="mobile_text">Login</strong></a></li>
							@else
								<li class=""><a href="{{url('/logout')}}" class="nav-link" aria-label="Read more about Seminole tax hike"><i class="fas fa-user"></i> <strong class="mobile_text">{{auth()->user()->first_name}}</strong></a></li>
							@endif
							<!-- <div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									@if(auth()->user())
										{{ auth()->user()->first_name }}
									@else
										<i class="fas fa-user"></i> Login
									@endif
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									@if(auth()->user())
										<a class="dropdown-item" href="{{ url('/logout') }}">
											<i class="fas fa-sign-out-alt"></i> Logout
										</a>
									@else
										<a class="dropdown-item" href="{{ url('/login') }}">
											<i class="fas fa-user"></i> Login
										</a>
									@endif
								</div>
							</div> -->
						</ul>
					</div>
				</div>

				<div class="col-md-3 mobile_menu_user" style="display: none;">
					<a class="navbar-brand img-fluid" href="{{ url('/') }}" aria-label="Read more about Seminole tax hike">
						<i class="mobile_user_icon fas fa-user"></i>
					</a>
				</div>
			</nav>
		</div>
	</div>
</header>
