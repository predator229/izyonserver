@extends('layouts/app')

@section('titre')
    Personnel
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
    <li ><a class="fa fa-user" href="{{ asset('user/profil') }}"> Profil</a></li>
    
    <li class="active"><a class="fa fa-users" href="{{ asset('reglage/personnelplus') }}"> Personnel</a></li>
    @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
    <li ><a class="fa fa-gears" href="{{ asset('reglage/reglagebase') }}"> Reglage de base</a></li>
    @endif
    
  </ul>
</li>
    
@endsection

@section('content')
  
  <section id="container">

    <div class="row">
        
        <div class="col-lg-12 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head btn-block">
              <h3>Nouveau vendeur </h3>
              
            </div>
            <?php $verif=false; ?>
            <div class="content-panel">
                <div class="container-fluid">
                    <div class="col-md-10">                    
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-block btn-success" href="{{ asset('regale/user/addnewuser') }}">Voir la liste</a>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <form method="POST" action="{{ asset('reglage/user/addnewuserSave') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-md-4">
                            <label for="seuil">Choisir image</label>                            
                            <div class="fileupload fileupload-new " data-provides="fileupload">
                              <div class="fileupload-new thumbnail btn-block" >
                                <img src="{{ asset('img/profil/fr-02.jpg') }}" alt="" class="btn-block"/>
                              </div>
                              <div class="fileupload-preview fileupload-exists thumbnail btn-block" style="max-width: 600px; max-height: 600px; line-height: 20px;"></div>
                              <div>
                                <span class="btn btn-theme02 btn-file btn-block">
                                  <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                  <input type="file" class="default" name="image"/>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="prenom" class="form-label text-md-right">{{ __('Prenom') }}</label>
                                  <input id="prenom" type="text" class="form-control{{ $errors->has('prenom') ? ' is-invalid' : '' }}" name="prenom" value="{{ old('prenom') }}" required autofocus>
                                  @if ($errors->has('prenom'))
                                  <span class="invalid-feedback text-danger text-danger" role="alert">
                                      <strong>{{ $errors->first('prenom') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="col-md-6">
                                  <label for="nom" class="form-label text-md-right">{{ __('Nom') }}</label>
                                  <input id="nom" type="text" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ old('nom') }}" required >
                                  @if ($errors->has('nom'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="email" class="form-label text-md-right">{{ __('E-Mail Address') }}</label>
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                            </div>
                          
                            <div class="form-group">
                              <label for="adresse" class="form-label text-md-right">{{ __('Address') }}</label>
                              <input id="email" type="text" class="form-control{{ $errors->has('adresse') ? ' is-invalid' : '' }}" name="adresse" value="{{ old('adresse') }}" required>

                              @if ($errors->has('adresse'))
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $errors->first('adresse') }}</strong>
                                  </span>
                              @endif
                            </div>
                        
                            <div class="form-group">
                              <div class="row">
                                
                                <div class="col-md-6">
                                    <label for="" class="form-label text-md-right"><i class="fa fa-phone"></i> {{ __('Telephone') }} </label>
                                    <input id="" type="text" class="form-control" name="telephone" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label text-md-right">{{ __('Type dutilisateur') }}</label>
                                  <select name="typeUtilisateur" class="form-control">
                                    @if(Auth()->User()->typeUtilisateur == "AdminSysteme")
                                    <option value="AdminSysteme">Administrateur</option>
                                    <option value="Gerant">Gerant</option>
                                    <option value="Vendeur">Vendeur</option>
                                    @endif
                                    @if(Auth()->User()->typeUtilisateur == "Gerant")
                                    <option value="Vendeur">Vendeur</option>
                                    @endif
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="password" class="form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
  
                                      @if ($errors->has('password'))
                                          <span class="invalid-feedback text-danger text-danger" role="alert">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif       
                                  </div>
                                  <div class="col-md-6">
                                      <label for="password-confirm" class="form-label text-md-right">{{ __('Confirm Password') }}</label>
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                  </div>
                                </div>
                              </div>
                            <br>
                            <div class="form-group text-center">
                              <label for="seuil" class="text-danger ">( * = Information obligatoire)</label>                                                          
                            </div>                            
                            
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col-xs-4"></div>
                          <div class="col-xs-4"></div>
                          <div class="col-xs-4">
                            <div class="form-group">                             
                              <button type="submit" class="btn btn-primary btn-block">
                                  {{ __('Enregistrer') }}
                              </button>
                            </div>
                          </div>
                        </div>
                          
                    </form>
                  
                    <hr>
                    
                    
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