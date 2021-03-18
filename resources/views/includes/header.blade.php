<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="{{ route('home') }}">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is light logo icon--><img src="{{ URL::asset('img/RGAsesores.gif') }}" height="55" alt="home"
                        class="light-logo" />
                </b>
                </span> </a>
        </div>
        
        <!-- /Logo -->
        @if (Auth::user() != null)
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <a class="nav-toggler open-close waves-light hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <img src="{{ Storage::url(Auth::user()->img) }}" alt="user-img" width="36" class="img-circle">
                    <b class="hidden-xs">{{Auth::user()->name}}</b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                        <div class="u-img"><img src="{{ Storage::url(Auth::user()->img) }}" alt="user" /></div>
                            <div class="u-text"><h4>{{Auth::user()->name}}</h4><p class="text-muted">{{Auth::user()->email}}</p></div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('profile')}}"><i class="ti-user"></i> Mi perfil</a></li>
                    <li><a href="{{route('documents.mydocs', Auth::user()->name)}}"><i class="ti-wallet"></i> Mis archivos</a></li>
                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="ti-settings"></i> Ajustes de cuenta</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>{{ __('Cerrar sesión') }}
                        </a>
            
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            
            <!-- /.dropdown -->
        </ul>
        @endif
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
    
</nav>