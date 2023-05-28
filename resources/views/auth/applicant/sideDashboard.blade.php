<div class="leftUserDashboardNav">
    <div class="userDashboardNav">
        <img src="/img/JobPlaza_logov2.png" alt="JobPlaza">
    </div>

    <div class="navi">
        <p class="{{ request()->is('/') ? 'active' : '' }}">
            <a  href="{{ route('jobs.index') }}">Home</a>
        </p>
        
        <p  class="{{ request()->is('applicant/dashboard') ? 'active' : '' }}" >
            <a href="{{ route('applicant.app') }}">Job Applications</a>
        </p>
        <p class="{{ request()->is('applicant/profile') ? 'active' : '' }}">
            <a  href="{{ route('applicant.profile') }}">Profile</a>
        </p>
    </div>
    <div class="logoutCon">
        <a href="{{ route('applicant.logout') }}">Logout</a>
    </div>
</div>