<header class="header black-bg" id="enhaut">
    <div class="sidebar-toggle-box">
      <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="{{ asset('home') }}" class="logo"><b><span>I</span><i style="color : gray">zy</i> STOCK</b></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
      <!--  notification start -->
      <ul class="nav top-menu"> 
        <!-- settings start -->
        <li>
          <a href="#">
            {{ App\Boutique::first()->nomEtablissement }} {{ App\Annexe::all()->count() == 1 ? "" : App\Annexe::findOrFail(Auth()->User()->idannexe)->nomAnnexe }}
          </a>
        </li>
        <li class="text-danger">
          <a class="text-danger" href="{{ asset('locks') }}">
            <i class="fa fa-lock text-danger"></i>
            {{-- <span class="label label-theme pull-right mail-info"></span> --}}
            </a>
        </li>
      </ul>
      <!--  notification end -->
    </div>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
        {{-- <li><a class="logout btn btn-danger" href="{{ asset('locks') }}"><i class="fa fa-lock text-danger"></i></a></li> --}}
        <li><a class="logout btn-danger" data-toggle="modal" href="#myModal">Se deconnecter</a></li>
      </ul>
    </div>
  </header>
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Deconnexion ?</h4>
        </div>
        <div class="modal-body">
          <p>Voulez-vous vraiment vous deconnecter ?.</p>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
          <a class="btn btn-danger" href="{{ asset('logOut') }}">Se deconnecter</a>
        </div>
      </div>
    </div>
  </div>
 
