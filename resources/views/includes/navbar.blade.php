<nav class="nav">
    <div class="container-fluid">
        <div class="navbar">
            <div class="logo">
                <img src="/img/JobPlaza_logov2.png" alt="JobPlaza">
            </div>
        </div>
        <div class="navbarRightside">
            <div class="navlink">
                <ul>
                    <li><a class="{{ request()->is('/') ? 'active-link' : '' }}" href="{{ route('jobs.index') }}">Jobs</a></li>
                    <li><a class="{{ request()->is('employers') ? 'active-link' : '' }}" href="{{ route('employer.index') }}">Company</a></li>
                </ul>
            </div>
            <div class="rLP">
                @if(session()->has('LoggedUser'))
                    <p class="{{ request()->is('employer/profile') ? 'active' : '' }}">
                        <a href="{{ route('employer.profile') }}">Profile</a>
                    </p>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <p><a href="#">/</a></p>
                    <a href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>
