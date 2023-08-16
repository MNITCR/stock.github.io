<div id="content">
    <nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">
        <!-- Sidebar Toggler (Sidebar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <ul class="navbar-nav ml-auto">
            {{-- dark mode --}}
            {{-- <li class="nav-item dropdown">
                <span class="nav-link fs-4" role="button" id="darkmode">
                    <i class="fa-solid fa-moon"></i>
                </span>
            </li> --}}

            {{-- profile --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 fs-6">{{ session('username') }}</span>
                    <img class="img-profile rounded-circle" src="https://media.istockphoto.com/id/912299634/photo/computer-crime-concept.jpg?s=612x612&w=0&k=20&c=JOYSw69V4tr2hvnAt3HsOEbyXAoSXYulHrh8ifqqJXk=">
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
