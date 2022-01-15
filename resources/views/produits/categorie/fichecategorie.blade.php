@extends('layouts/app')


@section('titre')
    Categorie-Fiche
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
    <li class="active"><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categories des produits</a></li>
    <li class=""><a class="fa fa-list" href="{{ asset('products/allProduct') }}"> Liste des produits</a></li>
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
              <h3>Fiche Categorie </h3>
              
            </div>
            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2>Categorie: </h2><h3> <?php echo App\CategorieProduit::findOrFail($id)->libelle; ?> ( <?php echo $produits = App\Produit::whereIdcategorie($id)->get()->count(); ?> )</h3>
                            <p><button class="btn btn-danger"><i class="fa fa-print"></i> Imprimer</button></p>

                        </div>
                    </div>
                </div>
                <?php $produits = App\Produit::whereIdcategorie($id)->get(); ?>
                @foreach ($produits as $produit)
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="row content-panel">
                            <!-- /col-md-4 -->
                            <div class="col-md-3"></div>
                            <div class="col-md-3 profile-text">
                                <h4>{{ $produit->libelle }}</h4>
                                <h5>Description : </h5>                                
                                <p>{!! $produit->description !!}</p>
                                <br>
                                <p><button class="btn btn-danger"><i class="fa fa-print"></i> Imprimer</button></p>
                            </div>
                            <!-- /col-md-4 -->
                            <div class="col-md-3 centered">
                                <div class="profile-pic">
                                <p><a href="{{ asset('products/fichetechnique/'.$produit->id.'') }}"><img src="{{ asset($produit->imageProduit) }}" class="img-circle"></a></p>
                            </div>
                            </div>
                            <!-- /col-md-4 -->
                            </div>
                            <!-- /row -->
                        </div>
                    </div>
                    <br>
                @endforeach
                
            </div>

            
        
    </div>
  </section>


@endsection