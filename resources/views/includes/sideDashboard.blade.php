<div class="leftUserDashboardNav">
    <div class="userDashboardNav">
        <img src="/img/JobPlaza_logov2.png" alt="JobPlaza">
    </div>

    <div class="navi">
        <p class="{{ request()->is('/') ? 'active' : '' }}">
            <a  href="{{ route('jobs.index') }}">Home</a>
        </p>
        
        <p  class="{{ request()->is('employer/dashboard') ? 'active' : '' }}" >
            <a href="{{ route('layout.app') }}">Posted jobs</a>
        </p>
        <p class="{{ request()->is('employer/profile') ? 'active' : '' }}">
            <a  href="{{ route('employer.profile') }}">Profile</a>
        </p>
        <p class="{{ request()->is('job/create') ? 'active' : '' }}" >
            <a href="{{ route('job.createForm') }}">Post job</a>
        </p>
    </div>
    <div class="logoutCon">
        <a href="{{ route('logout') }}">Logout</a>
    </div>
</div>