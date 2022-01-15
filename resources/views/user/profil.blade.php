@extends('layouts/app')

@section('titre')
    Profil
@endsection

@section('menupage')

<li class="mt">
  <a class="" href="{{ asset('home') }}">
    <i class="fa fa-dashboard"></i>
    <span>Dashboard</span>
    </a>
</li>
<li class="sub-menu">
  <a href="javascript:;">
    <i class="fa fa-star"></i>
    <span>Produits</span>
    </a>
  <ul class="sub">
    <li ><a class="fa fa-list" href="{{ asset('products/allCategorie') }}"> Categories des produits</a></li>
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
    <span class="label label-theme pull-rlight mail-info"></span>
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
  <a class="active" href="javascript:;">
    <i class="fa fa-cogs"></i>
    <span>Reglages</span>
    </a>
  <ul class="active sub">
    <li class="active"><a class="fa fa-user" href="{{ asset('user/profil') }}"> Profil</a></li>
    <li ><a class="fa fa-users" href="{{ asset('reglage/personnelplus') }}"> Personnel</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li ><a class="fa fa-gears" href="{{ asset('reglage/reglagebase') }}"> Reglage de base</a></li>
    @endif
  </ul>
</li>
    
@endsection

@section('content')
    
  <section id="container">

    <div class="row">
        
        <div class="container">
            <h2 >Profil</h2>
            <hr>
            <div class="row container">
              @if($errors->any())
              <script> alert("{{$errors->first()}}"); </script>
              @endif
                <div class="col-md-4 ">
                  <div class="row">
                    <div class="col-xs-10"><h3 class="text-center">Information generale</h3></div>
                    <div class="col-xs-2 text-right"> <h3 ><button class="btn btn-danger" onclick="lafonct2()"><i class="fa fa-edit"></i></button></h3> </div>
                  </div>
                  <form action="{{ asset('user/updatee/info') }}" method="post" >
                    {{ csrf_field() }}
                    
                    
                    <hr>
                    <div class="form-group">
                        <label for="name">Votre nom</label>
                        <input type="text" class="form-control text-right" name="name" id="name" value="{{ Auth()->User()->name }}" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Votre adresse</label>
                        <input type="text" class="form-control text-right" id="adresse" value="{{ Auth()->User()->adresse }}" name="adresse" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Votre telephone</label>
                        <input type="text" class="form-control text-right" name="telephone" id="telephone" value="{{ Auth()->User()->telephone }}" name="telephone" readonly required>
                    </div>
                    <div class="form-group" id="siclique">
                      <input type="submit" class="form-control btn btn-success btn-block" value="Enregistrer les modifications">
                    </div>
                  </form>
                </div>
                
                  <div class="col-md-4">
                    <div class="row">
                        <div class="col-xs-10"><h3 class="text-center">Mot de passe</h3></div>
                        <div class="col-xs-2 text-right"> <h3 ><button class="btn btn-danger" onclick="lafonct3()"><i class="fa fa-edit"></i></button></h3> </div>
                    </div>
                    <hr>
                    <form action="{{ asset('user/updatee/pass') }}" method="post" >
                      {{ csrf_field() }}
                      
                    <div class="form-group">
                        <label for="ancienpass">Ancien mot de passe</label>
                        <input type="password" class="form-control" id="pass0" name="ancienpass" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="newmdp">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="pass1" name="newmdp" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="confirmnewmdp">Confirmer le nouveau mot de passe</label>
                        <input type="password" class="form-control" id="pass2" name="confirmnewmdp" readonly required>
                    </div>
                    
                    <div class="form-group" id="siclique2">
                      <input type="submit" class="form-control btn btn-success" value="Enregistrer les modifications">
                      {{-- <button data-toggle="modal" class="form-control btn btn-success btn-block" href="#lemod">Enregistrer les modification</button> --}}
                    </div>
                    {{-- <div aria-hidden="true" aria-labelledby="lemod" role="dialog" tabindex="-1" id="lemod" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" >
                            <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Changement de mot de passe ?</h4>
                          </div>
                          <div class="modal-body">
                            <p>Voulez-vous vraiment changer votre mot de passe ?.</p>
                          </div>
                          <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <input type="submit" class="form-control btn btn-success" value="Enregistrer les modifications">
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </form>
                </div>
                <div class="col-md-4 " style="align-center" >

                    <ul class="sidebar-menu" id="nav-accordion">
                      <p class="centered"><a href="{{ asset('profile') }}"><img src="{{ asset(Auth()->User()->cheminImage) }}" class="img-circle" width="80"></a></p>
                      
                      <h5 class="centered">{{ Auth()->User()->name }} <br>{{ Auth()->User()->typeUtilisateur }}</h5>

                      <div class="text-center"><a href="{{ asset('facturation/total/'.Auth()->User()->id) }}"> Toutes mes ventes <i class="fa fa-print"></i></a></div>
                    </ul>
                    
                  </div>
              </div>
            </div>
        </div>

        
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('lib/jquery-ui-1.9.2.custom.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
  
    </div>
    <script>

        jQuery(document).ready(function () {      
                jQuery("#siclique1").hide();       
                jQuery("#siclique").hide();       
                jQuery("#siclique2").hide();       
            });
        function lafonct1(){
          if ($("#siclique1").is(":hidden")) {          
            $("#siclique1").show();
            $("#siclique").hide();  

            
    document.getElementById("name").readOnly = true;
    document.getElementById("adresse").readOnly = true;
    document.getElementById("telephone").readOnly = true;                
            // $("#sub").hide();             
          }else {          
            $("#siclique1").hide();            
          }

        }

        function lafonct2(){
    if ($("#siclique").is(":hidden")) {          
      $("#siclique").show();
      $("#siclique1").hide();       
      $("#siclique2").hide();       

      document.getElementById('name').readOnly = false;      
      document.getElementById('adresse').readOnly = false;      
      document.getElementById('telephone').readOnly = false;   
      
    document.getElementById("pass0").readOnly = true;
    document.getElementById("pass1").readOnly = true;
    document.getElementById("pass2").readOnly = true;
         
      // $("#sub").hide();             
    }else {          
      $("#siclique").hide();    

    document.getElementById("name").readOnly = true;
    document.getElementById("adresse").readOnly = true;
    document.getElementById("telephone").readOnly = true;

    }
        }

        function lafonct3(){
    if ($("#siclique2").is(":hidden")) {          
      $("#siclique2").show();
      $("#siclique1").hide();       
      $("#siclique").hide();       

      document.getElementById('pass0').readOnly = false;      
      document.getElementById('pass1').readOnly = false;      
      document.getElementById('pass2').readOnly = false;   
      
    document.getElementById("name").readOnly = true;
    document.getElementById("adresse").readOnly = true;
    document.getElementById("telephone").readOnly = true;
         
      // $("#sub").hide();             
    }else {          
      $("#siclique2").hide();       
      document.getElementById("pass0").readOnly = true;
    document.getElementById("pass1").readOnly = true;
    document.getElementById("pass2").readOnly = true;

    }
        }
      </script>
  </section>
@endsection