@extends('layouts/app')


@section('titre')
    Produits-Stocks
@endsection


@section('menupage')

<li class="mt">
  <a class="" href="{{ asset('home') }}">
    <i class="fa fa-dashboard"></i>
    <span>Dashboard</span>
    </a>
</li>
{{-- Menu produit --}}
<li class="sub-menu">
  <a class="" href="javascript:;">
    <i class="fa fa-star"></i>
    <span>Produits</span>
    </a>
  <ul class="sub">
    <li  class=""><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categorie des produits</a></li>
    <li><a class="fa fa-list" href="{{ asset('products/allProduct') }}"> Liste des produits</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li><a class="fa fa-plus-square-o" href="{{ asset('products/newProduct') }}"> Ajouter un produit</a></li>
    @endif
  </ul>
</li>
{{-- Menu approvisionnement --}}
@if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
{{-- Menu approvisionnement --}}
<li class="">
  <a class="" href="{{ asset('products/approvisionnement/newApprovisonnement') }}">
    <i class="fa fa-plus-circle"></i>
    Approvisionnement
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
@endif
{{-- Menu client--}}
<li>
  <a class="active" href="{{ asset('nouveauClient') }}">
    <i class="fa fa-users"></i>
    Client
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>{{-- Menu stock--}}
<li>
  <a class="" href="{{ asset('stocks') }}">
    <i class="fa fa-gamepad"></i>
    Stock
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
{{-- Menu vente --}}
<li>
  <a class="" href="{{ asset('products/vente/nouvelleVente') }}">
    <i class="fa fa-share"></i>
    <span>Vente </span>
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
<li>
  <a class="" href="{{ asset('products/facture/liste') }}">
    <i class="fa fa-credit-card"></i>
    <span>Factures </span>
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
{{-- Menu registre --}}
@if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
<li class="sub-menu">
  <a class="" href="javascript:;">
    <i class="fa fa-stack-exchange"></i>
    <span>Registres</span>
    </a>
  <ul class="sub">
    <li ><a class="" href="{{ asset('registres/entrees') }}"> Entrées</a></li>
    <li ><a class="" href="{{ asset('registres/sorties') }}"> Sorties (Vente)</a></li>
    {{-- @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant') --}}
    <li ><a class="" href="{{ asset('registres/users') }}"> Utilisateurs</a></li>
    {{-- @endif --}}
  </ul>
</li>
@endif
<li class="sub-menu">
  <a class="" href="javascript:;">
    <i class="fa fa-cogs"></i>
    <span>Reglages</span>
    </a>
  <ul class="sub">
    <li ><a class="fa fa-user" href="{{ asset('user/profil') }}"> Profil</a></li>
    <li ><a class="fa fa-users" href="{{ asset('reglage/personnelplus') }}"> Personnel</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li ><a class="fa fa-gears" href="{{ asset('reglage/reglagebase') }}"> Reglage de base</a></li>
    @endif
  </ul>
</li>
<br><br>
<br><br>
<br><br>
    
@endsection

@section('content')
    
  <section id="container">

    <div class="row">
        
        <div class="col-lg-12 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head btn-block">
              <h3> Nouveau client </h3>
              
            </div>
            
            <div class="content-panel">
              <div class="container-fluid">
                <div class="col-md-8">                    
                </div>
              </div>
              <br>
              <div class="container-fluid">
                <form action="{{ asset('/client/new/default') }}" method="post">    
                  {{ csrf_field() }}                    
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-7">
                        <input type="text" placeholder="Entrer le nom du client" class="form-control" name="name" required>
                      </div>
                      <div class="col-xs-3">
                        <input type="text" placeholder="Entrer le telephone" class="form-control" name="tel" required>
                      </div>
                      <div class="col-xs-2 ">
                        <input type="submit" class="btn btn-success form-control" value="+">
                      </div>
                    </div>
                  </div>
                </form>
                  <hr>
                  <div class="border-head btn-block">
                    <h3>Client</h3>                      
                  </div>
                  
                  <div class="table-responsive table-bordered">
                    <table class="table table-responsive table-bordered" >
                        <thead>
                        <tr style="font-size: 14px">
                            <th class="text-center">#</th>
                            <th class="text-center">Nom du client</th>
                            <th class="text-center">Tel</th>
                        </tr>
                        </thead>
                        <?php $lesapprovisonnement = App\Client::all(); ?>
                        <tbody>
                          @foreach ($lesapprovisonnement as $item)
                            <tr>
                                <th class="text-center">{{ $item->id }}</th>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->tel }}</td>
                            </tr>
                          @endforeach
                          @if ($lesapprovisonnement->count() == 0)
                          <tr>
                            <td class="text-center text-danger" colspan="5">Aucune enregistre pour le moment</td>
                        </tr>
                          @endif
                        </tbody>
                    </table>
                </div>
              </div>

              
            </div>
            
        </div>
        
    </div>

  </section>
@endsection