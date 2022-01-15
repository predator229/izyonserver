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
<li class="">
  <a class="active" href="{{ asset('products/approvisionnement/newApprovisonnement') }}">
    <i class="fa fa-plus-circle"></i>
    Approvisionnement
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li>{{-- Menu stock--}}
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
              <h3>Nouvel approvisionnement </h3>
              
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
                    <form action="{{ asset('products/addApprovisionnement') }}" method="post">    
                      {{ csrf_field() }}                    
                      <div class="form-group">
                        <div class="row">
                          <div class="col-xs-10">
                            <div class="col-xs-10">
                              <select class="form-control" name="idproduit"  >
                                <?php $lesproduits = App\Produit::whereIdannexe(Auth()->User()->idannexe)->get(); ?>
                                @foreach ( $lesproduits as $item)
                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                @endforeach
                                @if ($lesproduits->count() == 0)
                                  <option value="">Pas encore de produit. Veuillez ajouter un produit d'abord.</option>
                                @endif
                              </select>
                            </div>
                            <div class="col-xs-2">
                              <input type="number" id="lenombre" placeholder="nbre" class="form-control" value="1" min="1" name="nbre" required>
                            </div>
                          </div>
                          <div class="col-xs-2 ">
                            @if ($lesproduits->count() != 0)
                            <a class="btn btn-success" data-toggle="modal" href="#addAppro" onclick="lafonct()">Enregistrer</a>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div aria-hidden="true" aria-labelledby="addAppro" role="dialog" tabindex="-1" id="addAppro" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" >
                              <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Confirmation ?</h4>
                            </div>
                            <div class="modal-body">
                              <p>Voulez-vous vraiment ajouter <span id="lavaleur"></span> unite(s) a ce produit ?.</p>
                            </div>
                            <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                              <input type="submit" class="btn btn-success" value="Confirmer">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
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
                              <th class="text-center">Nom du produit</th>
                              <th class="text-center">Operation</th>
                              <th class="text-right">Stock actuel</th>
                          </tr>
                          </thead>
                          <?php $lesapprovisonnement = App\Approvisonnement::whereIdannexe(Auth()->User()->idannexe)->orderBy('id', 'desc')->limit(5)->get(); ?>
                          <tbody>
                            @foreach ($lesapprovisonnement as $item)
                              <tr>
                                  <th class="">{{ $item->id }}</th>
                                  <td class="text-center">{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($item->idproduit)->idcategorie)->libelle }}</td>
                                  <td class="text-center">{{ App\Produit::findOrFail($item->idproduit)->libelle }}</td>
                                  <td class="text-center"> + {{ $item->nbre }}</td>
                                  <td class="text-right">{{ App\Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $item->idproduit)->first()->nbre }}</td>
                              </tr>
                            @endforeach
                            <?php $dernieres =  App\Facture::whereIdannexe(Auth()->User()->idannexe)->orderBy('id', 'desc')->get(); ?>
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
            <script>

            function lafonct()
            {
              document.getElementById("lavaleur").innerHTML = document.getElementById("lenombre").value;
              // document.getElementById("lavaleur2").innerHTML = document.getElementById("lenombre1").value;
            
            }

          </script>
        </div>
        
    </div>

  </section>
@endsection