<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fa fa-fw fa-area-chart"></i>
        <span class="nav-link-text">Dashboard</span>
      </a>

    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Usuarios</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ route('sucursal.index') }}">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Sucursales</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ route('cliente.index') }}">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Clientes</span>
        </a>
    </li>
</ul>
