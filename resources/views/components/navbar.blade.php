<nav>
    <div class="container">
        <div class="logo">
            <h1>Tracer<span>Study</span> IT Del</h1>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/questionnaire') }}">Questionnaire</a></li>
            <li><a href="{{ url('/usersurvey') }}">User Survey</a></li>
            <li><a href="{{ url('/report') }}">Tracer Study Report</a></li>
            <li><a href="{{ url('/#contact') }}">Contact</a></li>
            <li>
                @auth   
                    <!-- If the user is authenticated, show username and logout -->
                    <div class="dropdown">
                        <button class="btn btn-link nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Email: {{ Auth::user()->email }}</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- If the user is not authenticated, show login link -->
                    <a href="{{ route('login') }}" class="sign-in-btn">Masuk</a>
                @endauth
            </li>

        </ul>
    </div>
</nav>