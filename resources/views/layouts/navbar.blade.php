<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="javascript:;" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                {{ Auth::user()->nama }}
                <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.show') }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> User
                </a>
                <a href="javascript:;" class="dropdown-item" onclick="document.getElementById('form-logout').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i>Sign Out
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="javascript:;" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<form id="form-logout" action="/logout" method="POST" style="display: none">
    @csrf
    <button type="submit" name="logout"></button>
</form>