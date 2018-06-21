<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="{{asset('images/logo.png')}}" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="{{ url('/') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @role(['admin','agence'])
                <li>
                    <a href="{{ url('registration') }}"><i class="fas fa-address-book"></i>Inscription</a>
                </li>
                @endrole
                @role(['admin','aon'])
                <li>
                    <a href="{{ url('listing-registrations') }}"><i class="fas fa-list-alt"></i>Liste des souscriptions</a>
                </li>
                @endrole
                @role('admin')
                <li class="active">
                    <a  href="{{ url('appareil') }}"><i class="fas fa-mobile-alt"></i>Gestion des Appareils</a>
                </li>
                <li class="active">
                    <a  href="{{ url('users') }}"><i class="fas fa-users"></i>Gestion Utilisateur</a>
                </li>
                <li class="active">
                    <a  href="{{ url('agency') }}"><i class="fas fa-store-alt"></i>Agences</a>
                </li>
                @endrole
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('images/logo.png')}}" class="img-fluid" style="width:170px; height:70px;"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @role(['admin','agence'])
                <li class="{{ Request::is('registration*') ? 'active' : '' }}">
                    <a href="{{ url('registration') }}"><i class="fas fa-address-book"></i>Inscription</a>
                </li>
                @endrole
                @role(['admin','aon'])
                <li class="{{ Request::is('listing-registrations*') ? 'active' : '' }}">
                    <a  href="{{ url('listing-registrations') }}"><i class="fas fa-list-alt"></i>Liste des souscriptions</a>
                </li>
                @endrole
                @role('admin')
                <li class="{{ Request::is('appareil*') ? 'active' : '' }}">
                    <a  href="{{ url('appareil') }}"><i class="fas fa-mobile-alt"></i>Gestion des Appareils</a>
                </li>
                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                    <a  href="{{ url('users') }}"><i class="fas fa-users"></i>Gestion Utilisateur</a>
                </li>
                <li class="{{ Request::is('agency*') ? 'active' : '' }}">
                    <a  href="{{ url('agency') }}"><i class="fas fa-store-alt"></i>Agences</a>
                </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->