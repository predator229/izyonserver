@extends('layouts/app')

@section('titre')
    Dashbord
@endsection

@section('menupage')

<li class="mt">
  <a class="active" href="{{ asset('home') }}">
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
    <li ><a class="" href="{{ asset('registres/entrees') }}"> Entrées</a></li>
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
{{-- <li class="text-danger">
  <a class="text-danger" href="{{ asset('locks') }}">
    <i class="fa fa-lock"></i>Verrouiller
    <span class="label label-theme pull-right mail-info"></span>
    </a>
</li> --}}
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
              <h3>Dashbord <span class="text-danger float-right"><b>Resume du {{ Carbon\Carbon::now()->format('d/m/yy') }}</b></span></h3>
              {{-- <hr> --}}
            </div>
            
            <div class="container">

              <div>
                {{-- <div class="col-md-12">
                  <div class="chart">
                    
                    <br>
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                  </div>
                </div>
                 --}}
              </div>
                <div class="row">
                  
                  <div class="col-md-8">
                  

                    <div class="row"><h4 class="text-center">Rapport jounalier de vente </h4></div>
                    <?php 
                      $ventes = App\Facture::where('idemploye', Auth()->User()->id)
                                            // ->where( 'created_at', '>', date("d/m/yy"))
                                            ->get();
                    ?>
                    <?php $total = 0 ?>
                    @foreach ($ventes as $item)
                        {{-- @php
                        $ladiff = $item->created_at->diffInSeconds(Carbon\Carbon::now());
                        @endphp --}}
                        @if ($item->created_at->format('d/m/yy') == Carbon\Carbon::now()->format('d/m/yy') )
                          <?php $total += (float)$item->montant ?>
                         
                        @endif
                    @endforeach
                    <div class="row">
                      <div class="col-xs-6"> <h5> Recette de la journee </h5></div>
                      <div class="col-xs-6 text-right"> {{ $total }} XOF </div>                    
                    </div>
                    <div class="text-center"> <b> Details </b><hr></div>
                    <div class="table-responsive table-bordered">
                      <table class="table table-responsive table-bordered">
                        <thead>
                          <th>Nom du client</th>
                          <th class="text-center">Montant vendu</th>
                          <th class="text-center"> <a href="{{ asset('/facturation/journ/'.Auth()->User()->id) }}">Voir plus</a> </th>
                        </thead>
                        <tbody>
                          
                          
                          @foreach ($ventes as $item)
                          @if ($item->created_at->format('d/m/yy') == Carbon\Carbon::now()->format('d/m/yy') )
                          <tr>
                              <th>{{ App\Client::findOrFail($item->idclient)->name }}</th>
                              <th class="text-center">{{ $item->montant }}</th>
                              <th class="text-center"><a href="{{ asset('/facturation/journ/'.Auth()->User()->id) }}"><i class="fa fa-print text-danger"></i></a></th>
                            </tr>
                          @endif
                            
                          @endforeach
  
                          @if ($ventes->count() == 0)
                              <tr><td colspan="3"><div class="text-center">Auncune vente enregistree aujourdhui</div></td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div> 
                  </div>

                  @if (Auth()->User()->typeUtilisateur == "Vendeur")
                  <div class="col-md-4">
                  

                    <div class="row"><h4 class="text-center">Toutes mes ventes </h4></div>
                    <?php 
                      $ventes = App\Facture::where('idemploye', Auth()->User()->id)
                                            // ->where( 'created_at', '>', date("d/m/yy"))
                                            ->get();
                    ?>
                    <?php $total = 0 ?>
                    @foreach ($ventes as $item)
                        {{-- @php
                        $ladiff = $item->created_at->diffInSeconds(Carbon\Carbon::now());
                        @endphp --}}
                        {{-- @if ($item->created_at->format('d/m/yy') == Carbon\Carbon::now()->format('d/m/yy') ) --}}
                          <?php $total += (float)$item->montant ?>
                         
                        {{-- @endif --}}
                    @endforeach
                    <div class="row">
                      <div class="col-xs-6"> <h5> Recette de la totale de la journee </h5></div>
                      <div class="col-xs-6 text-right"> {{ $total }} XOF </div>                    
                    </div>
                    <div class="text-center"> <b> Details </b><hr></div>
                    <div class="table-responsive table-bordered">
                      <table class="table table-responsive table-bordered">
                        <thead>
                          <th>Date</th>
                          <th class="text-center">Montant vendu</th>
                          <th class="text-center">Repport</th>
                          
                          {{-- <th class="text-center">Voir plus</th> --}}
                        </thead>
                        <tbody>
                          
                          
                          @foreach ($ventes as $item)
                            @php
                              $day = $item->created_at->format('d/m/yy');
                              $ventess = App\Facture::where('idemploye', Auth()->User()->id)
                                                // ->where( 'created_at', '>', date("d/m/yy"))
                                                ->get();
                              $mtnfacture = 0;
                            @endphp
                            @foreach ($ventess as $itemm)
                              @if ( $itemm->created_at->format('d/m/yy') == $day)
                              @php
                                  $mtnfacture += $itemm->montant;
                              @endphp
                              
                              @endif
                            @endforeach
                            {{-- @php
                                
                              $tab[] = array($day, $mtnfacture);
                            
                            @endphp --}}
                            @if (true)
                            <tr>
                              <td> {{ $day }}</td>
                              <td>{{$mtnfacture}}</td>
                              <th class="text-center">
                              <form method="post" action="{{ asset('facturation/byday/'.Auth()->User()->id) }}"> @csrf <input type="text" class="sr-only" name="date" value="{{ $day }}"><button type="submit" class="btn"><i class="fa fa-print text-danger"></i></button></form>
                                
                              </th>
                            </tr>
                            @endif
                          @endforeach
                          {{-- @php
                              $tab[] = array_unique($tab);
                          @endphp
                          @foreach ($tab as $item)
                          <tr>
                            @foreach ($item as $a)
                            <td> {{ $a }}</td>

                            @endforeach --}}

                            {{-- <td> {{ $item }}</td> --}}
                            {{-- <td>{{$item[$mtnfacture]}}</td> --}}
                          {{-- </tr>
                          @endforeach --}}

                          @if ($ventes->count() == 0)
                              <tr><td colspan="3"><div class="text-center">Auncune vente enregistrée aujourdhui</div></td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div> 
                  </div>
                  @else
                  <div class="col-md-4">
                  

                    <div class="row"><h4 class="text-center">Tous mes vendeur (Recette du jour) </h4></div>
                    <?php 
                      $ventes = App\Facture::whereIdannexe(Auth()->User()->idannexe)->get();
                    ?>
                    <?php $total = 0 ?>
                    @foreach ($ventes as $item)
                        {{-- @php
                        $ladiff = $item->created_at->diffInSeconds(Carbon\Carbon::now());
                        @endphp --}}
                        @if ($item->created_at->format('d/m/yy') == Carbon\Carbon::now()->format('d/m/yy') )
                          <?php $total += (float)$item->montant ?>
                         
                        @endif
                    @endforeach
                    <div class="row">
                      <div class="col-xs-6"> <h5> Recette de la totale de la journee </h5></div>
                      <div class="col-xs-6 text-right"> {{ $total }} XOF </div>                    
                    </div>
                    <div class="text-center"> <b> Details </b><hr></div>
                    <div class="table-responsive table-bordered">
                      <table class="table table-responsive table-bordered">
                        <thead>
                          <th>Nom de l'employé</th>
                          <th class="text-center">Montant vendu</th>
                          <th>Repport</th>
                          {{-- <th class="text-center">Voir plus</th> --}}
                        </thead>
                        <tbody>
                          
                          @php
                              $ut = App\User::whereIdannexeAndDelete(Auth()->User()->idannexe, 'no')->orderBy('name')->get();
                          @endphp

                          @foreach ($ut as $it)
                            @php
                                $factures = App\Facture::whereIdemploye($it->id)->get();
                                $montantU = 0;
                            @endphp
                           
                            @foreach ($factures as $itemm)

                            @if ($itemm->created_at->format('d/m/yy') == Carbon\Carbon::now()->format('d/m/yy') )

                            @php
  
                              $montantU += $itemm->montant;
                                
                            @endphp

                            @endif
                              
                            @endforeach
                            @if ($it->typeUtilisateur != 'AdminSysteme')
                                <tr>
                                <th>{{ $it->name }}</th>
                                <th class="text-center">{{ $montantU }}</th>
                                <th class="text-center"><a href="{{ asset('/facturation/journ/'.$it->id) }}"><i class="fa fa-print text-danger"></i></a></th>
                              </tr>
                            @endif
                          @endforeach
  
                          @if ($ventes->count() == 0)
                              <tr><td colspan="3"><div class="text-center">Auncune vente enregistrée aujourdhui</div></td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div> 
                  </div>
                  @endif
                </div>
               
                
             
            </div>
        </div>
        
    </div>
@endsection