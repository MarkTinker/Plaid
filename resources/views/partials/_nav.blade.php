<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Laravel Blog</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ route('pages.dashboard') }}">Dashboard</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">               
        @if (Auth::check())
        <li>
          <a href="{{ route('profile.show', Auth::id()) }}">Profile</a>
        </li>
        <li>
          <a href="{{ route('account.show', Auth::id()) }}">Accounts</a>
        </li>   

        <li class="dropdown">
          
          <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </ul>
        </li>        
        @else
        <li>
          <a href="{{ route('login.facebook') }}">Login</a>
        </li>
        @endif

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>