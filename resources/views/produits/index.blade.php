@extends('layouts/app')


@section('titre')
    Produits-Liste
@endsection


@section('menupage')

<li class="mt">
  <a class="" href="{{ asset('home') }}">
    <i class="fa fa-dashboard"></i>
    <span>Dashboard</span>
    </a>
</li>
<li class="active sub-menu">
  <a class="active" href="javascript:;">
    <i class="fa fa-star"></i>
    <span>Produits</span>
    </a>
  <ul class="sub">
    <li ><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categories des produits</a></li>
    <li class="active"><a class="fa fa-list" href="{{ asset('products/allProduct') }}"> Liste des produits</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li ><a class="fa fa-plus-square-o" href="{{ asset('products/newProduct') }}"> Ajouter un produit</a></li>
    @endif
  </ul>
</li>
{{-- Menu approvisionnement --}}
@if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
<li>
  <a class="" href="{{ asset('products/approvisionnement/newApprovisonnement') }}">
    <i class="fa fa-plus-circle"></i>
    Approvisionnement
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
@endif
{{-- Menu stock--}}
<li>
  <a class="" href="{{ asset('nouveauClient') }}">
    <i class="fa fa-users"></i>
    Client
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
<li>
  <a class="" href="{{ asset('stocks') }}">
    <i class="fa fa-gamepad"></i>Stock
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
          <h3>Liste des produits </h3>
          
        </div>
        
        <div class="content-panel">
            <div class="container-fluid">
                <div class="col-md-10">                    
                </div>
                @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
                <div class="col-md-2">
                    <a class="btn btn-block btn-success" href="{{ asset('products/newProduct') }}">Nouveau produit</a>
                </div>
                @endif
            </div>
            <div class="table-responsive table-bordered">
              <table class="table table-responsive table-bordered" >
                          <thead>
                          <tr style="font-size: 14px">
                              <th class="">#</th>
                              <th class="text-center">Nom du produit</th>
                              <th class="text-center">Categorie du produit</th>
                              <th class="text-center">Prix du produit</th>
                              <th class="text-center">Qte en stock</th>
                              <th class="text-center">Seuil</th>
                              <th class="text-center">Voir la fiche</th>
                              <th class="text-right">Option</th>
                          </tr>
                          </thead>
                          <?php $lesproduits = App\Produit::whereIdannexe(Auth()->User()->idannexe)->get(); ?>
                          <tbody>
                            @foreach ($lesproduits as $item)
                              <tr>
                                <th class="">{{$item->id }}</th>
                                <td class="text-center">{!!  '<b>'.App\CategorieProduit::findOrFail($item->idcategorie)->libelle.'</b> '.$item->libelle !!}</td>
                                <td class="text-center">{{ App\CategorieProduit::findOrFail($item->idcategorie)->libelle }}</td>
                                <td class="text-center"><span class="badge text-danger">{{ $item->prix }} F</span></td>
                                <td class="text-center"><span class="badge text-danger">{{ isset(App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->id)->first()->nbre) ? App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->id)->first()->nbre : '0' }}</span></td>
                                <td class="text-center"><span class="badge text-danger">{{ $item->seuil }}</span></td>
                                <td class="text-center"><a href="{{ asset('products/fichetechnique/'.$item->id.'') }}"><i class="fa fa-search-plus"></i> Fiche technique du produit</a></td>
                                <th class="text-right">Option</th>
                              </tr>
                            @endforeach                              
                          </tbody>
                      </table>
          </div>
        </div>
        
    </div>
        
    </div>
  </section>
@endsection