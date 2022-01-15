@extends('layouts/app')


@section('titre')
    Vente-Nouvelle vente
@endsection


@section('menupage')

<li class="mt">
  <a class="" href="{{ asset('home') }}">
    <i class="fa fa-dashboard"></i>
    <span>Dashboard</span>
    </a>
</li>
<li class="sub-menu">
  <a class="" href="javascript:;">
    <i class="fa fa-star"></i>
    <span>Produits</span>
    </a>
  <ul class="sub">
    <li><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categorie des produits</a></li>
    <li><a class="fa fa-list" href="{{ asset('products/allProduct') }}"> Liste des produits</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li class=""><a class="fa fa-plus-square-o" href="{{ asset('products/newProduct') }}"> Ajouter un produit</a></li>
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
{{-- Menu client--}}
<li>
  <a class="" href="{{ asset('nouveauClient') }}">
    <i class="fa fa-users"></i>
    Client
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
{{-- Menu stock--}}
<li>
  <a class="" href="{{ asset('stocks/') }}">
    <i class="fa fa-gamepad"></i>
    Stock
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>
{{-- Menu vente --}}
<li>
  <a class="active" href="{{ asset('products/vente/nouvelleVente') }}">
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
              <h3>Nouvelle vente </h3>
              
            </div>
            <div class="content-panel">
                <div class="container-fluid">
                    <div class="col-md-10">                    
                    </div>
                    <div class="col-md-2">
                      <a href="{{ asset('products/vente/ficheventeGros') }}" class="btn btn-default btn-block">Panier <i class="fa fa-shopping-cart"></i></a>
                  </div>
                </div>
                <br>
                <div class="container-fluid">
                   <div class="row">
                     
                    <?php $lesproduits = App\Produit::whereIdannexe(Auth()->User()->idannexe)->get(); ?>
                    @if ($lesproduits->count() != 0)
                    
                    <form action="{{ asset('products/vente/fichevente') }}" method="post">
                      {{ csrf_field() }}
                      
                      <?php $verif = false; ?>
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <label class="label-control container" for="produit">Selectionner le produit</label>
                            <div class="col-xs-10">
                              <select class="form-control" name="produit" id="lenombre" onfocusout="lafonct()">
                                
                                @foreach ($lesproduits as $item)
                                {{ $verif = true }}
                                  @if (isset(App\Stock::whereIdproduit($item->id)->first()->nbre))
                                    <option value="{{ $item->id }}" >{{ App\CategorieProduit::findOrFail($item->idcategorie)->libelle.' '.$item->libelle.' ('.$item->prix.' XOF, Stock : '}} {{ isset(App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->id)->first()->nbre) ? App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->id)->first()->nbre.' )' : '0 )' }}</option>
                                  @endif
                                  
                                @endforeach
                              </select>
                            </div>
                            <div class="col-xs-2">
                              @if ($verif)
                              <input type="submit" value="ok" class="btn btn-success fa-check-circle">
                              @endif
                            </div>
                          </div>                          
                        </div>
                        <div class="col-md-2"></div>

                      </div>
                    <form>
                    @endif
                    
                        <br>
                        <hr>
                        <br>
                        <div class="border-head btn-block">
                          <h3>Dernieres ventes</h3>                      
                        </div>
                        <div class="table-responsive table-bordered">
                          <table class="table table-responsive table-bordered">
                            <thead>
                              <th>Facture No</th>
                              <th class="text-center">Client</th>
                              <th class="text-center">Montant de vente</th>
                            </thead>
                            <tbody>
                              <?php $dernieres =  App\Facture::whereIdannexe(Auth()->User()->idannexe)->orderBy('id', 'desc')->get(); ?>
                                @foreach ($dernieres as $item)
                                <tr>
                                  <th>{{ $item->id }}</th>
                                  <th class="text-center">{{ App\Client::findOrFail($item->idclient)->name }}</th>
                                  <th class="text-center">{{ $item->montant }}</th>
                                </tr>
                                @endforeach
                                @if ($dernieres->count() == 0)
                                    <tr><td colspan="3"><div class="text-center">Auncune vente enregistree pour le moment</div></td>
                                @endif
                            </tbody>
                          </table>
                      </div>
                  </div>
                  
                </div>
            </div>
      
            
        </div>
        
    </div>

  </section>
@endsection