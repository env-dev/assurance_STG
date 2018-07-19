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
                @role('admin')
                <li class="{{ Request::is('/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @endrole
                <li class="{{ Request::is('listing-registrations*') ? 'active' : '' }}">
                    <!-- <a href="#submenu1"><i class="fas fa-list-alt"></i>Les souscriptions</a> -->
                    <a class="nav-link collapsed" href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fas fa-align-left"></i>Les souscriptions &nbsp;&nbsp;<i class="fas fa-caret-square-down"></i></a>
                    <div class="collapse" id="submenu1" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                @role(['agence','admin'])
                                <li class="nav-item"><a class="nav-link py-0 my-3" href="{{ url('registration') }}"><i class="far fa-plus-square"></i>Ajouter souscription</a></li>
                                @endrole
                                <li class="nav-item"><a class="nav-link py-0 my-3" href="{{ url('listing-registrations') }}"><i class="fas fa-list-alt"></i>Liste souscriptions</a></li>
                            </ul>
                    </div>
                </li>
                @role(['admin','aon'])
                <li class="{{ Request::is('listing-avenants*') ? 'active' : '' }}">
                    <a href="{{ url('listing-avenants') }}"><i class="fas fa-list-alt"></i>Liste des avenants</a>
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
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo text-center">
        <a href="#">
            <img src="{{asset('images/logo.png')}}" class="img-fluid" style=" height:70px;"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @role('admin')
                <li class="{{ Request::is('/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @endrole
                <li class="{{ Request::is('listing-registrations*') ? 'active' : '' }}">
                    <!-- <a href="#submenu1"><i class="fas fa-list-alt"></i>Les souscriptions</a> -->
                    <a class="nav-link collapsed" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="far fa-address-card"></i>Les souscriptions &nbsp;&nbsp;<i class="fas fa-caret-square-down"></i></a>
                    <div class="collapse" id="submenu2" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                @role(['agence','admin'])
                                <li class="nav-item"><a class="nav-link py-0 my-3" href="{{ url('registration') }}"><i class="far fa-plus-square"></i>Ajouter souscription</a></li>
                                @endrole
                                <li class="nav-item"><a class="nav-link py-0 my-3" href="{{ url('listing-registrations') }}"><i class="fas fa-list-alt"></i>Liste souscriptions</a></li>
                            </ul>
                    </div>
                </li>
                @role(['admin','aon'])
                <li class="{{ Request::is('listing-avenants*') ? 'active' : '' }}">
                    <a href="{{ url('listing-avenants') }}"><i class="fas fa-list-alt"></i>Liste des avenants</a>
                </li>
                @endrole
                <li class="{{ Request::is('claims*') ? 'active' : '' }}">
                    <a class="nav-link collapsed" href="#claims" data-toggle="collapse" data-target="#claims"><i class="fas fa-align-left"></i>Les sinistres &nbsp;&nbsp;<i class="fas fa-caret-square-down"></i></a>
                    <div class="collapse" id="claims" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                                @role(['agence','admin'])
                                <li class="nav-item"><a class="nav-link py-0 my-3" href="{{ url('listing-registrations') }}"><i class="far fa-plus-square"></i>Ajouter sinistre</a></li>
                                @endrole
                                <li class="nav-item"><a class="nav-link py-0 my-3" href="{{ url('listing-sinisters') }}"><i class="fas fa-list-alt"></i>Liste sinistre</a></li>
                            </ul>
                    </div>
                </li>
                <li class="{{ Request::is('listing-reparations*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('listing-reparations') }}"><i class="fas fa-wrench"></i>Les reparations &nbsp;&nbsp;</i></a>
                </li>
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
                <li>
                    <a class="nav-link collapsed" href="#stock" data-toggle="collapse" data-target="#stock"><i class="fas fa-calculator"></i> Gestion Stock &nbsp;&nbsp;<i class="fas fa-caret-square-down"></i></a>
                    <div class="collapse" id="stock" aria-expanded="false">
                        <ul class="flex-column pl-4 nav">
                            <li class="nav-item {{ Request::is('gestion*') ? 'active' : '' }}"><a  href="{{ url('gestion-stock') }}"><i class="fas fa-database"></i> Gestion Stock</a></li>     
                            <li class="nav-item {{ Request::is('status*') ? 'active' : '' }}"><a  href="{{ url('status') }}"><i class="fas fa-mobile"></i> Smarphone Etat</a></li>
                        </ul>
                    </div>
                </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->