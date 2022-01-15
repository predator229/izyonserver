@extends('layouts/app')


@section('titre')
    Produits-Fiche
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
@endif{{-- Menu stock--}}
<li>
  <a class="" href="{{ asset('nouveauClient') }}">
    <i class="fa fa-users"></i>
    Client
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li><li>
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
              <h3>Fiche technique </h3>
              
            </div>
            <?php $produit = App\Produit::findOrFail($id); ?>

            <div class="">
              <div class="row mt">
                <div class="col-lg-12">
                    <div class="row content-panel">
                    <!-- /col-md-4 -->
                    <div class="col-md-3"></div>
                    <div class="col-md-3 profile-text">
                        <h5 class="text-right"><b>{{ App\CategorieProduit::findOrfail($produit->idcategorie)->libelle }}</b></h5>
                        <h4 >{{ $produit->libelle }}</h4>
                        <h5>Description : </h5>                                
                        <p>{!! $produit->description !!}</p>
                        
                        <br>
                        <p><button class="btn btn-danger"><i class="fa fa-print"></i> Imprimer</button></p>
                    </div>
                    <!-- /col-md-4 -->
                    <div class="col-md-3 centered">
                        <div class="profile-pic">
                        <p><a target="_blank" href="{{ asset($produit->imageProduit) }}"><img src="{{ asset($produit->imageProduit) }}" class="img-circle"></a></p>
                    </div>
                    </div>
                    <!-- /col-md-4 -->
                    </div>
                    <!-- /row -->
                </div>
            </div>
            </div>

            <div class="panel-body">
                <div class="tab-content">
                  <div id="overview" class="tab-pane active">
                    <div class="row">
                      <div class="col-md-12">
                        
                        <div class="detailed mt">
                          <h4>Derniere vente</h4>
                          <div class="recent-activity">
                            <div class="activity-icon bg-theme"><i class="fa fa-check"></i></div>
                            <div class="activity-panel">
                              @php
                                  $ladernierevente = App\Vente::whereIdproduit($id)->get()->last();
                              @endphp
                              <h5>{{ isset($ladernierevente) ? ''.$ladernierevente->created_at->format('d/m/y H:i') : ''}}</h5>
                              
                              <p>Vendue à : {{ isset($ladernierevente) ? ''.App\Client::findOrFail($ladernierevente->idclient)->name : ''}}.</p>
                            </div>
                            <div class="activity-icon bg-theme04"><i class="fa fa-rocket"></i></div>
                            <div class="activity-panel">
                              <h5>Quantite en stock</h5>
                              <p>{{ isset(App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $produit->id)->first()->nbre) ? App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $produit->id)->first()->nbre : '0' }}</p>
                            </div>
                          </div>
                          <!-- /recent-activity -->
                        </div>

                        <div class="row centered mb">
                         
                          <div class="row mt">
                            <div class="btn-block text-center">
                              <h6><a href="{{ asset('products/fichecategorie/'.$produit->idcategorie) }}">Voir tous les produits de la meme categorie</a></h6>
                            </div>
                          </div>
                        </div>
                        <!-- /detailed -->
                      </div>
                      <!-- /col-md-6 -->
                      
                      <!-- /col-md-6 -->
                    </div>
                    <!-- /OVERVIEW -->
                  </div>
                  <!-- /tab-pane -->
                  
                  <!-- /tab-pane -->
                  
                  <!-- /tab-pane -->
                </div>
                <!-- /tab-content -->
              </div>
        
    </div>
  </section>


@endsection