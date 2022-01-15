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
        
        <div class="container">
            <h2 >Utilisateurs</h2>
            <hr>
            <div class="row">
        
                <div class="col-lg-12 main-chart">
                    
                        <div class="container-fluid">
                            <div class="col-md-10">                    
                            </div>
                            <div class="col-md-2">
                                @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
                                <a class="btn btn-block btn-success" href="{{ asset('regale/user/addnewuser') }}"> <i class="fa fa-plus"></i> Nouveau Vendeur</a>
                                @endif
                            </div>
                            
                            <hr>
                            <div class="border-head btn-block">
                              <h3>Tous les utilisateurs </h3>                      
                            </div>
                            <div class="table-responsive table-bordered">
                              <table class="table table-responsive table-bordered" >
                                  <thead>
                                  <tr style="font-size: 14px">
                                      <th class="">#</th>
                                      <th class="text-center">Nom</th>
                                      <th class="text-center">Adresse</th>
                                      <th class="text-center"><i class="fa fa-phone"></i></th>
                                      <th class="text-center"><i class="fa fa-envelope-o"></i></th>
                                      <th class="text-center">Poste / Fonction</i></th>
                                      @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
                                      <th class="text-center"><i class="fa fa-print"></i></th>
                                      <th class="text-center"><i class="fa fa-times"></i></th>
                                      @endif
                                  </thead>
                                  <?php $lesusersd = App\User::whereIdannexe(Auth()->User()->idannexe)
                                                            ->where("typeUtilisateur", "!=", "AdminSysteme")
                                                            // ->where("delete", "no")
                                                            ->get();
                                    ?>
                                  <tbody>
                                    @foreach ($lesusersd as $item)
                                      <tr>
                                        <th class="">{{$item->id }}</th>
                                        <td class="text-center">{{ $item->name }} </td>
                                        <td class="text-center">{{ $item->adresse }}</td>
                                        <td class="text-center"><span class="badge text-danger">{{ $item->telephone }}</span></td>
                                        <td class="text-center"><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                                        <td class="text-center">{{ $item->typeUtilisateur }}</td>
                                        @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant')
                                        <td class="text-center"><a href="{{ asset('facturation/total/'.$item->id) }}"><i class="fa fa-print"></i></a></td>
                                        @php
                                              if ($item->delete == 'oui')
                                                echo '<td class="text-center"><i class="fa fa-times text-dark"></i></td>';
                                              else
                                                echo '<td class="text-center"><a data-toggle="modal" href="#suppr-'.$item->id.'"><i class="fa fa-times text-danger"></i></a></td>';
                                          @endphp
                                          
                                          
                                          
                                          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="suppr-{{ $item->id}}" class="modal fade">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header" >
                                                  <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <h4 class="modal-title">Suppression de code ?</h4>
                                                </div>
                                                <form action="{{ asset('user/desactivation/'.$item->id)}}" method="POST">
                                                  @csrf
                                                  <div class="modal-body">
                                                    <strong><p>Voulez-vous vraiment supprimer cet utilisateur ?</strong><br> <br><strong>{{ $item->typeUtilisateur }} : </strong>{{ $item->name }}, {{ $item->adresse }}, {{ $item->telephone }}, {{ $item->email }}</p>
                                                    <input type="text" class="form-control" name="motif" placeholder="Motif de supression" autofocus required>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-primary" type="button">Annuler</button>
                                                    <button class="btn btn-danger" type="submit">Confirmer</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        @endif
                                    </tr>
                                    @endforeach                              
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>

        
       
    </div>
    
  </section>
@endsection