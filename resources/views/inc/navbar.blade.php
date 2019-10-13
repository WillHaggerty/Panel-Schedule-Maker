<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav mr-auto">
        @guest
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/home') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{ url('/jobs') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jobs</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/jobs') }}">View All Jobs</a>
            <a class="dropdown-item" href="{{ url('/jobs/create') }}">Add Job</a>
            @yield('recentJobs')
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{ url('/panels') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Panels</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="@yield('panelCreateLink', '#')">Add a Panel</a>
            @yield('recentPanels')
          </div>
        </li>
        @endguest
      </ul>
      {{-- Right Side Of Navbar --}}
      <ul class="navbar-nav ml-auto">
        {{-- Authentication Links --}}
        @guest
        <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
