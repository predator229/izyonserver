@extends('layouts/app')


@section('titre')
    Produits-Nouveau
@endsection


@section('menupage')

<li class="mt">
  <a class="" href="{{ asset('home') }}">
    <i class="fa fa-dashboard"></i>
    <span>Dashboard</span>
    </a>
</li>
<li class="sub-menu">
  <a class="active" href="javascript:;">
    <i class="fa fa-star"></i>
    <span>Produits</span>
    </a>
  <ul class="sub">
    <li><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categorie des produits</a></li>
    <li><a class="fa fa-list" href="{{ asset('products/allProduct') }}"> Liste des produits</a></li>
    <li class="active"><a class="fa fa-plus-square-o" href="{{ asset('products/newProduct') }}"> Ajouter un produit</a></li>
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
  <a class="" href="{{ asset('stocks/') }}">
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
              <h3>Nouveau produit </h3>
              
            </div>
            <?php $verif=false; ?>
            <div class="content-panel">
                <div class="container-fluid">
                    <div class="col-md-10">                    
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-block btn-success" href="{{ asset('products/allProduct') }}">Voir la liste</a>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <form action="{{ asset('products/newProductSave') }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="description">Description du produit <span class="text-danger">(*)</span></label>
                              <textarea name="description" id="description" cols="30" rows="12" class="form-control" placeholder="Entrer la description ici" required></textarea>
                            </div>
                          </div>
                          <div class="col-md-4">
                              
                            <div class="form-group">
                              <label for="nomProduit">Nom du produit <span class="text-danger">(*)</span></label>
                              <input type="text" placeholder="Entrer le nom du produit" class="form-control" name="nom" required>
                            </div>
                            
                            <div class="form-group">
                              <div class="row">
                                <div class="col-xs-6">
                                  <label for="idcategorie">Categorie de ce produit <span class="text-danger">(*)</span></label>
                                  <select class="form-control" name="categorie">
                                    <?php $lescategories = App\CategorieProduit::whereIdannexe(Auth()->User()->idannexe)->get(); ?>
                                    @foreach ($lescategories as $item)
                                      {{ $verif = true }}
                                      <option value="{{ $item->id }}" >{{ $item->libelle }}</option>
                                    @endforeach
                                  </select>       
                                </div>
                                <div class="col-xs-6">
                                  <label for="prix">Prix (XOF) <span class="text-danger">(*)</span></label>
                                  <input type="number" class="form-control" name="prix" value="1" min="1" required>                                   
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="row">
                                <div class="col-xs-6">
                                  <label for="prix">Quantite initiale <span class="text-danger">(*)</span></label>
                                  <input type="number" class="form-control" name="quantite" value="0" min="0" required>     
                                </div>
                                <div class="col-xs-6">
                                  <label for="seuil">Quantite seuil <span class="text-danger">(*)</span></label>                            
                                  <input type="number" class="form-control" name="seuil" value="0" min="0">                              
                                </div>
                              </div>
                            </div> 
                            <br>
                            <div class="form-group text-center">
                              <label for="seuil" class="text-danger ">( * = Information obligatoire)</label>                                                          
                            </div>                            
                            
                          </div>
                          <div class="col-md-4">
                            <label for="seuil">Choisir image</label>                            
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="fileupload-new thumbnail" style="width: 300px; height: 200px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                              </div>
                              <div class="fileupload-preview fileupload-exists thumbnail btn-block" style="max-width: 300px; max-height: 200px; line-height: 20px;"></div>
                              <div>
                                <span class="btn btn-theme02 btn-file btn-block">
                                  <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                  <input type="file" class="default" name="imageProduit"/>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          @if ($verif)
                            <input type="submit" value="Enregistrer" class="btn btn-success">
                          @endif
                        </div>
                    </form>
                    <hr>
                    <div class="border-head btn-block">
                      <h3>Les 05 derniers produits enregistres </h3>                      
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
                          <?php $lesproduits = App\Produit::whereIdannexe(Auth()->User()->idannexe)->orderBy('id', 'desc')->limit(5)->get(); ?>
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
        
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jquery-ui-1.9.2.custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
  </section>
@endsection