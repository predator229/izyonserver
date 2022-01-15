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
              <h3>Nouveau vente </h3>
              
            </div>
            <?php $verif=false; ?>
            <div class="content-panel">
                <div class="container-fluid">
                    <div class="col-md-10">                    
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-block " href="{{ asset('products/vente/nouvelleVente') }}"><i class="fa fa-arrow-circle-o-left"></i> Retour</a>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    
                          
                          <form action="{{ asset('products/vente/storeInPanier/'.$id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="nomProduit">Produit selectionne</label>
                              <input type="text" value="{{ App\Produit::findOrFail($id)->libelle }}"  readonly class="form-control">
                              </select>
                            </div>
                            <?php $prix = App\Produit::findOrFail($id)->prix ?>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-xs-4">
                                    <label for="prix">Prix </label>
                                    <input type="number" value="{{ App\Produit::findOrFail($id)->prix }}" class="form-control" readonly name="qte" id="qtE" value="1" min="1">
                                  </div>
                                  <div class="col-xs-4">
                                    <label for="prix">S.I </label>
                                    <input type="number" value="{{ isset(App\Stock::whereIdproduit($id)->first()->nbre) ? App\Stock::whereIdproduit($id)->first()->nbre : '0' }}" class="form-control" readonly name="qte" id="stockI" value="1" min="1">
                                  </div>
                                  <div class="col-xs-4">
                                    <label for="prix">Categorie </label>
                                    <input type="text" value="{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($id)->idcategorie)->libelle }}" class="form-control" readonly>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                  <div class="col-xs-5">
                                    <label for="prix">Quantite </label>
                                    <input type="number" class="form-control" name="qteVendu" id="qteVendu" value="1" min="1" onkeyup="changeMontant()" max="{{ isset(App\Stock::whereIdproduit($id)->first()->nbre) ? App\Stock::whereIdproduit($id)->first()->nbre : '0' }}">
                                  </div>
                                  
                                  <div class="col-xs-3">
                                    <label for="prix">S.R </label>
                                    <input type="number" value="{{ isset(App\Stock::whereIdproduit($id)->first()->nbre) ? App\Stock::whereIdproduit($id)->first()->nbre - 1 : '0' }}" class="form-control" readonly name="qte" id="stock" value="1" min="1">
                                  </div>

                                  <div class="col-xs-4">
                                    <label for="prix">Tot.B </label>
                                  <input type="text" class="form-control" id="totalBrute" value="{{ App\Produit::findOrFail($id)->prix *1 }}" readonly>
                                  </div>
                                </div>
                              </div>

                            <div class="form-group">
                              <div class="row">
                                <div class="col-xs-4">
                                  <input type="radio" name="optionsRadios" id="remise" value="option2" onclick="changeMode()"> Remise en %
                                </div>                                
                                <div class="col-xs-4">
                                  <input type="radio" name="optionsRadios" id="montant" value="option2" onclick="changeMode()"> Montant directe
                                </div>
                                <div class="col-xs-4">
                                  <input type="radio" name="optionsRadios" id="aucun" checked onclick="changeMode()"> Aucun                                  
                                </div>
                              </div>
                            </div>
                            <div class="form-group text-right">
                              <div class="row">
                                <div class="col-xs-4" id="remiseDiv">
                                  <label class="text-right">% </label>
                                  <input type="number" class="form-control" readonly id="remiseIn" value="0" onkeyup="remiseCalc()">
                                </div>                                
                                <div class="col-xs-4" id="montantDiv">
                                  <label class="text-right">Mt de vente</label>
                                  <input type="number" class="form-control"  id="montantIn" value="{{ App\Produit::findOrFail($id)->prix *1 }}" readonly onkeyup="montCal()">
                                </div>
                                <div class="col-xs-4">
                                  <label class="text-right">Total</label>
                                  <input type="number" name="subtot" class="form-control" value="{{ App\Produit::findOrFail($id)->prix *1 }}" readonly style="border-color: green" id="ttc">
                                </div>
                              </div>
                            </div>

                            <div class="form-group" id="subM">
                              <input type="submit" value="Enregistrer" class=" btn btn-success" >
                            </div>
                          </form>
                    
                    <hr>
                    
                    
                </div>
            </div>
            
        </div>
        
    </div>

    <script>

      
      function lafonct()
      {
        var ontest = document.getElementById("lenombre").value;

        alert (ontest);
      }

      function changeMontant(){
        // alert("text-right");
        document.getElementById("totalBrute").value = document.getElementById("qteVendu").value * {{ App\Produit::findOrFail($id)->prix }};
        document.getElementById("ttc").value = document.getElementById("totalBrute").value ;
        document.getElementById("montantIn").value = document.getElementById("totalBrute").value;

        document.getElementById("stock").value = {{ isset(App\Stock::whereIdproduit($id)->first()->nbre) ? App\Stock::whereIdproduit($id)->first()->nbre : '0' }} - document.getElementById("qteVendu").value;

        if (document.getElementById("stock").value >= 0) {          
          $("#subM").show();

          if (document.getElementById("remise").checked == true) {
            document.getElementById("ttc").value = document.getElementById("totalBrute").value * ( 1 - document.getElementById("remiseIn").value / 100);
          }
        }
        else
          $("#subM").hide();
      }

      function changeMode(){
        if (document.getElementById("remise").checked == true) {          
          $("#remiseDiv").show();            
          $("#montantDiv").hide();     

          document.getElementById("remiseIn").readOnly = false;
          document.getElementById("montantIn").readOnly = true;       
        }

        if (document.getElementById("montant").checked == true) {          
          $("#remiseDiv").hide();            
          $("#montantDiv").show();

          document.getElementById("remiseIn").readOnly = true;
          document.getElementById("montantIn").readOnly = false;

        }

        if (document.getElementById("aucun").checked == true) {          
          $("#remiseDiv").show();            
          $("#montantDiv").show();

          document.getElementById("remiseIn").readOnly = true;
          document.getElementById("montantIn").readOnly = true;

          document.getElementById("remiseIn").value = 0;
          document.getElementById("ttc").value = document.getElementById("qteVendu").value * {{ App\Produit::findOrFail($id)->prix }};
          document.getElementById("montantIn").value = document.getElementById("qteVendu").value * {{ App\Produit::findOrFail($id)->prix }};

        }
        
        
      }

      function remiseCalc() {
        if (document.getElementById("remise").checked == true) 
          document.getElementById("ttc").value = document.getElementById("totalBrute").value * ( 1 - document.getElementById("remiseIn").value / 100);

        
        if (document.getElementById("remiseIn").value >= 100)          
          $("#subM").hide();
        else
        $("#subM").show();
      }

      function montCal() {
        if (document.getElementById("montant").checked == true) 
          document.getElementById("ttc").value = document.getElementById("montantIn").value;
      }
    </script>
  </section>
@endsection