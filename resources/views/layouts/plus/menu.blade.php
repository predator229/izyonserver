<aside>
    
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="{{ asset('profile') }}"><img src="{{ asset(Auth()->User()->cheminImage) }}" class="img-circle" width="80"></a></p>
          
          <h5 class="centered">{{ Auth()->User()->name }} <br>{{ Auth()->User()->typeUtilisateur }}</h5>
          @yield('menupage')
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>