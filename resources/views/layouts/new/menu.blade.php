<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="fa fa-fw fa fa-calendar"></i>
        <span class="nav-link-text">Calendario</span>
      </a>

    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="fa fa-fw fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Usuarios</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sucursales">
        <a class="nav-link" href="{{ route('sucursal.index') }}">
          <i class="fa fa-fw fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Sucursales</span>
        </a>
    </li>

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Clientes">
        <a class="nav-link" href="{{ route('cliente.index') }}">
          <i class="fa fa-fw fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Clientes</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tratamientos">
        <a class="nav-link" href="{{ route('tratamiento.index') }}">
          <i class="fa fa-fw fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Tratamientos</span>
        </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reservas">
        <a class="nav-link" href="{{ route('rotativo.index') }}">
          <i class="fa fa-fw fa-user" aria-hidden="true"></i>
          <span class="nav-link-text">Tratamientos Rotativos</span>
        </a>
    </li>
</ul>
