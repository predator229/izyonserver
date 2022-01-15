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
<li>
  <a class="" href="{{ asset('nouveauClient') }}">
    <i class="fa fa-users"></i>
    Client
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
{{-- Menu stock--}}
<li>
  <a class="active" href="{{ asset('stocks') }}">
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
              <h3> Stocks </h3>
              
            </div>
            
            <div class="content-panel">
              <div class="container-fluid">
                <div class="col-md-8">                    
                </div>
              </div>
              <br>
              <div class="container-fluid">
                  <hr>
                  <div class="border-head btn-block">
                    <h3>Stocks actuelle</h3>                      
                  </div>
                  <div class="table-responsive table-bordered">
                    <table class="table table-responsive table-bordered" >
                        <thead>
                        <tr style="font-size: 14px">
                            <th class="text-center">#</th>
                            <th class="text-center">Categorie et nom du produit</th>
                            <th class="text-center">Stock actuel</th>
                        </tr>
                        </thead>
                        <?php $lesapprovisonnement = App\Stock::whereIdannexe(Auth()->User()->idannexe)->get(); ?>
                        <tbody>
                          @foreach ($lesapprovisonnement as $item)
                            <tr>
                                <th class="text-center">{{ $item->id }}</th>
                                <td class="text-center">{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($item->idproduit)->idcategorie)->libelle." ".App\Produit::findOrFail($item->idproduit)->libelle }}</td>
                                <td class="text-center">{{ $item->nbre }}</td>
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

              <div class="container-fluid">
                <hr>
                <div class="border-head btn-block">
                  <h3>10 dernieres operations</h3>                      
                </div>
                <div class="table-responsive table-bordered">
                  <table class="table table-responsive table-bordered" >
                      <thead>
                      <tr style="font-size: 14px">
                          <th class="">#</th>
                          <th class="text-center">Nom de la categorie</th>
                          <th class="text-center">Nom du produit</th>
                          <th class="text-center">Operation</th>
                              <th class="text-center">Date</th>
                              <th class="text-right">Stock actuel</th>
                      </tr>
                      </thead>
                      <?php $lesapprovisonnement = App\Approvisonnement::whereIdannexe(Auth()->User()->idannexe)->orderBy('id', 'desc')->limit(5)->get(); ?>
                      <?php $dernieres =  App\Vente::whereIdannexe(Auth()->User()->idannexe)->orderBy('id', 'desc')->limit(5)->get(); ?>
                      <tbody>
                        <tr ><td colspan="5"><div class="text-center text-warning">Les ventes</div></td></tr>
                        @foreach ($dernieres as $item)
                          <tr>
                              <th class="">#</th>
                              <td class="text-center">{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($item->idproduit)->idcategorie)->libelle }}</td>
                              <td class="text-center">{{ App\Produit::findOrFail($item->idproduit)->libelle }}</td>
                              <td class="text-center"> ({{ $item->qte }})</td>
                              <td class="text-center">{{ $item->created_at->format('j/m/yy') }}</td>
                              {{-- <td class="text-right">{{ App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->idproduit)->first()->nbre }}</td>
                               --}}
                              <td class="text-right"><span class="badge badge-success">{{ App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->idproduit)->first()->nbre }}</span></td>

                          </tr>
                        @endforeach
                        <tr ><td colspan="5"><div class="text-center text-warning">Les approvisionnements</div></td></tr>
                        @foreach ($lesapprovisonnement as $item)
                          <tr>
                              <th class="">#</th>
                              <td class="text-center">{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($item->idproduit)->idcategorie)->libelle }}</td>
                              <td class="text-center">{{ App\Produit::findOrFail($item->idproduit)->libelle }}</td>
                              <td class="text-center"> + {{ $item->nbre }}</td>
                              <td class="text-center">{{ $item->created_at->format('j/m/yy') }}</td>
                              <td class="text-right"><span class="badge badge-success">{{ App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->idproduit)->first()->nbre }}</span></td>
                          </tr>
                        @endforeach
                        
                      </tbody>
                  </table>
              </div>
            </div>
            </div>
            
        </div>
        
    </div>

  </section>
@endsection