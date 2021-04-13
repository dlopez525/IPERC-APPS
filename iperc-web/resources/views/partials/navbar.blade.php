<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="index.html">
                    <img src="{{ asset('img/logo-iso.png') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('home') }}" class="nav-link"> {{ config('app.name', 'Laravel') }} </a>
            </li>
        </ul>
        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item" style="color: #fff;">{{ auth()->user()->name }} | <small>{{ auth()->user()->type_user == 1 ? 'Administrador' : 'Super Administrador' }}</small></li>
            <li class="nav-item dropdown user-profile-dropdown px-3">
                <a class="" href="{{ route('logout') }}" style="color: #fff; fill: #fff;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></a>
                {{-- <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="{{ asset('img/90x90.jpg') }}" alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            
                        </div>
                    </div>
                </div> --}}
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->
<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">
                    <div class="page-title">
                        {{-- <h3>{{ $this->headquarter != null ? auth()->user()->headquarter->name : '' }}</h3> --}}
                        <h3>{{ currentHeadquater() }}</h3>
                    </div>
                </div>
            </li>
        </ul>
        @if (auth()->user()->isSuperAdmin())
            <ul class="navbar-nav flex-row ml-auto mr-3">
                <li class="nav-item more-dropdown">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#changeHeadquarter">Cambiar de Sede</button>
                </li>
            </ul>
        @endif
    </header>
</div>
<!--  END NAVBAR  -->