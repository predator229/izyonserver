@extends('layouts/app')


@section('titre')
    Factures-liste
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
@if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
{{-- Menu approvisionnement --}}
<li class="">
  <a class="" href="{{ asset('products/approvisionnement/newApprovisonnement') }}">
    <i class="fa fa-plus-circle"></i>
    Approvisionnement
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
@endif{{-- Menu client--}}
<li>
  <a class="" href="{{ asset('nouveauClient') }}">
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
  <a class="active" href="{{ asset('products/facture/liste') }}">
    <i class="fa fa-credit-card"></i>
    <span>Factures </span>
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
@if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
<li class="sub-menu">
  <a class="" href="javascript:;">
    <i class="fa fa-stack-exchange"></i>
    <span>Registres</span>
    </a>
  <ul class="sub">
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
              <h3> Les factures </h3>
              
            </div>
            
            <div class="content-panel">
              <div class="container-fluid">
                <div class="col-md-8">                    
                </div>
              </div>
              <br>
              <div class="container-fluid">                
                  <hr>
                  <div class="border-head btn-block text-right">
                    <h3>Les factures</h3>                      
                  </div>
                  
                  <div class="table-responsive table-bordered">
                    <table class="table table-responsive table-bordered" >
                        <thead>
                        <tr style="font-size: 14px">
                            <th class="text-center">#</th>
                            <th class="text-center">Client</th>
                            <th class="text-center">Montant de la vente</th>
                            <th class="text-center">Date vente</th>
                            <th class="text-center"><span class="badge badge-danger">Impression</span></th>
                        </tr>
                        </thead>
                        <?php $lesapprovisonnement = App\Facture::orderBy("id", "desc")->get(); ?>
                        <tbody>
                          @foreach ($lesapprovisonnement as $item)
                            <tr>
                                <th class="text-center">{{ $item->id }}</th>
                                <td class="text-center">{{ App\Client::findOrFail($item->idclient)->name }}</td>
                                <td class="text-center">{{ $item->montant }}</td>
                                <td class="text-center">{{ $item->created_at->format("d/m/Y H:i") }}</td>
                                <td class="text-center"><a href="{{ asset('facturation/print/'.$item->id) }}"><i class="text-danger fa fa-print"></i></a></td>
                                
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