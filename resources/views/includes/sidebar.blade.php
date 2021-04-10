<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav slimscrollsidebar">
    <div class="sidebar-head">
      <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span>
        <span class="hide-menu">Navigation</span></h3>
    </div>
    <ul class="nav" id="side-menu">
      <li style="padding: 70px 0 0;">
        <a href="{{route('home')}}" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Panel de
          Control</a>
      </li>
      @if(Auth::user()->admin != 1)
      <li>
        <a href="{{route('profile')}}" class="waves-effect"><i class="fa fa-user fa-fw"
            aria-hidden="true"></i>Perfil</a>
      </li>
      <li>
        <a href="{{route('updocument')}}" class="waves-effect"><i class="fa fa-file-pdf-o fa-fw"
            aria-hidden="true"></i>Subir Documento</a>
      </li>
      @endif
      @if(Auth::user()->admin == 1)
      <li>
        <a href="#"
          class="waves-effect {{ (request()->is('personasfisicas')) ? 'active' : (((request()->is('empresas')) ? 'active' : ((request()->is('sociedades')) ? 'active' : '')))}}"><i
            class="fa fa-list-ul fa-fw" aria-hidden="true"></i>Clientes<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li><a href="{{route('personasfisicas')}}" class="waves-effect"><i class="fa fa-users fa-fw"
                aria-hidden="true"></i>Personas físicas </a></li>
          <li><a href="{{route('empresas')}}" class="waves-effect"><i class="fa fa-briefcase fa-fw"
                aria-hidden="true"></i>Empresas </a></li>
          <li><a href="{{route('sociedades')}}" class="waves-effect"><i class="fa fa-university fa-fw"
                aria-hidden="true"></i>Sociedades </a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('documents.index')}}" class="waves-effect"><i class="fa fa-folder fa-fw"
            aria-hidden="true"></i>Documentos</a>
      </li>
      <li>
        <a href="{{route('register')}}" class="waves-effect"><i class="fa fa-user-plus fa-fw"
            aria-hidden="true"></i>Añadir persona física</a>
      </li>
      <li>
        <a href="{{route('empresa')}}" class="waves-effect"><i class="fa fa-briefcase fa-fw"
            aria-hidden="true"></i>Añadir empresa</a>
      </li>
      <li>
        <a href="{{route('sociedad')}}" class="waves-effect "><i class="fa fa-university fa-fw"
            aria-hidden="true"></i>Añadir sociedad</a>
      </li>
      @endif
      <li>
        <a href="{{route('consultas.index')}}" class="waves-effect"><i class="fa fa-book fa-fw"
            aria-hidden="true"></i>Consultas</a>
      </li>
      <li>
        <a href="{{route('newConsulta')}}" class="waves-effect"><i class="fa fa-book fa-fw"
            aria-hidden="true"></i>Crear consulta</a>
      </li>
      <li>
        <a href="{{route('calendar')}}" class="waves-effect"><i class="fa fa-calendar fa-fw"
            aria-hidden="true"></i>Calendario</a>
      </li>
    </ul>
  </div>
</div>