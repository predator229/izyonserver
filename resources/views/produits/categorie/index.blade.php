@extends('layouts/app')


@section('titre')
    Produits-Categorie
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
  <a class="active" href="javascript:;">
    <i class="fa fa-star"></i>
    <span>Produits</span>
    </a>
  <ul class="sub">
    <li  class="active"><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categorie des produits</a></li>
    <li><a class="fa fa-list" href="{{ asset('products/allProduct') }}"> Liste des produits</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li><a class="fa fa-plus-square-o" href="{{ asset('products/newProduct') }}"> Ajouter un produit</a></li>
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
              <h3>Categorie(s) </h3>
              
            </div>
            
            <div class="content-panel">
                <div class="container-fluid">
                    <div class="col-md-8">                    
                    </div>
                    {{-- <div class="col-md-4">
                        <a class="btn btn-block btn-success" href="{{ asset('products/allProduct') }}">Voir la liste des produits</a>
                    </div> --}}
                </div>
                <br>
                <div class="container-fluid">
                  @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
                    <form action="{{ asset('products/addCategorie') }}" method="post">    
                      {{ csrf_field() }}                    
                      <div class="form-group">
                        <div class="row">
                          <div class="col-xs-10">
                            <input type="text" placeholder="Entrer le nom de la categorie" class="form-control" name="libelle" required>
                          </div>
                          <div class="col-xs-2 ">
                            <input type="submit" class="btn btn-success form-control" value="Enregistrer">
                          </div>
                        </div>
                      </div>
                    </form>
                    @endif
                    <hr>
                    <div class="border-head btn-block">
                      <h3>Liste</h3>                      
                    </div>
                    <div class="table-responsive table-bordered">
                      <table class="table table-responsive table-bordered" >
                          <thead>
                          <tr style="font-size: 14px">
                              <th class="">#</th>
                              <th class="text-center">Nom de la categorie</th>
                              <th class="text-center">Voir plus</th>
                              <th class="text-center">Nbre type de produit</th>
                              <th class="text-right">Option</th>
                          </tr>
                          </thead>
                          <?php $lescategories = App\CategorieProduit::whereIdannexe(Auth()->User()->idannexe)->get(); ?>
                          <tbody>
                            @foreach ($lescategories as $item)
                              <tr>
                                  <th class="">{{ $item->id }}</th>
                                  <td class="text-center">{{ $item->libelle }}</td>
                                  <td class="text-center"><a href="{{ asset('products/fichecategorie/'.$item->id) }}"><i class="fa fa-search-plus"></i></a></td>
                                  <td class="text-center"><?php echo App\Produit::whereIdcategorie($item->id)->get()->count(); ?></td>
                                  <th class="text-right">Option</th>
                              </tr>
                            @endforeach
                            @if ($lescategories->count() == 0)
                            <tr>
                              <td class="text-center text-danger" colspan="4">Aucune categorie enregistree pour le moment</td>
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