@extends('layouts/app')

@section('titre')
    Registre des ventes
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
  <a class="active" href="javascript:;">
    <i class="fa fa-stack-exchange"></i>
    <span>Registres</span>
    </a>
  <ul class="sub">
    <li ><a class="" href="{{ asset('registres/entrees') }}"> Registres des approvisionnement</a></li>
    <li class="active"><a class="" href="{{ asset('registres/sorties') }}"> Registre des vente</a></li>
    {{-- @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant') --}}
    <li ><a class="" href="{{ asset('registres/users') }}"> Registre utilisateurs</a></li>
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

    <div class="container">
        
       

        <div class="row mt">
            <div class="col-lg-11">
              <!-- CHART PANELS -->
              <div class="row">
                {{-- <div class="col-md-5 col-sm-5 mb">
                  <div class="grey-panel pn donut-chart">
                    <div class="grey-header">
                      <h5>SERVER LOAD</h5>
                    </div>
                    <canvas id="serverstatus01" height="120" width="120"></canvas>
                    <script>
                      var doughnutData = [{
                          value: 70,
                          color: "#FF6B6B"
                        },
                        {
                          value: 30,
                          color: "#fdfdfd"
                        }
                      ];
                      var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                    </script>
                    <div class="row">
                      <div class="col-sm-6 col-xs-6 goleft">
                        <p>Usage<br/>Increase:</p>
                      </div>
                      <div class="col-sm-6 col-xs-6">
                        <h2>21%</h2>
                      </div>
                    </div>
                  </div>
                  <!-- /grey-panel -->
                </div> --}}
                <!-- /col-md-4-->
                {{-- <div class="col-md-1"></div> --}}
                <div class="col-md-12 col-sm-12 mb" >
                  <form action="{{ asset('print/find') }}" method="POST">
                    @csrf
                  <div class="darkblue-panel pn" >
                    <div class="darkblue-header">
                      <h5>RECHERCHE</h5>
                    </div>
                    <div id="aremplacer" >
                        <div class="row">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-8 col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="user" id="se" class="form-control">
                                                @php
                                                    $lesutilisateurs = App\User::where('idannexe', Auth()->User()->idannexe)->get();
                                                @endphp
                                                    <option value="0"> Tous les utilisateurs </option>
                                                    @foreach ($lesutilisateurs as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <input type="date" class="form-control" name="date" value="{{ Carbon\Carbon::now()->format('d/m/y') }}" id="date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary" type="button" onclick=" aprescliquement()" >Rechercher</button>
                                    </div>
                                </div>
             
                            </div>
                            <div class="col-xs-2 col-md-2"></div>
                        </div>
                    </div>
                    
                    <canvas id="serverstatus02" height="120" width="120"></canvas>

                   <div style="display: none;" id="boum">
                        {{-- <button type="submit"><i class="fa fa-print text-warning"></i></button> --}}
                        <a id="testclique" href=""><i class="fa fa-print"></i></a>

                    </div>
                    {{-- <p>April 17, 2014</p> --}}
                    {{-- <p>April 17, 2014</p> --}}
                    {{-- <footer>
                      <div class="pull-left">
                        <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
                      </div>
                      <div class="pull-right">
                        <h5>60% Used</h5>
                      </div>
                    </footer> --}}
                  </div>
                  </form>
                  <!--  /darkblue panel -->
                </div>
                <!-- /col-md-4 -->
              </div>  
            </div>
        </div>
        <div class="row">
            <h6>Toutes ventes</h6>
            <div class="row">
                <div class="col-xs-9"></div>
                <div class="col-xs-2">
                    <a class="text-danger" href={{ asset('print/allsell') }}> Repport <i class="fa fa-print"></i></a>
                </div>
                
            </div>
            <br>
            <div class="col-md-11">
                <div class="adv-table table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered table-responsive" id="hidden-table-info">
                        <thead>
                            <th>Qté</th>
                            <th>Produit </th>
                            <th>Catégorie </th>
                            <th>Prix de vente </th>
                            <th>Vendeur </th>
                            <th>Client </th>
                            <th>Date </th>
                        </thead>
                        <tbody>
                            @php
                                $collection = App\Vente::where('idannexe', Auth()->User()->idannexe)->get();
                            @endphp
                            @foreach ($collection as $item)
                                <tr>
                                    <td>{{ $item->qte }}</td>
                                    <td>{{ App\Produit::findOrFail($item->idproduit)->libelle }}</td>
                                    <td>{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($item->idproduit)->idcategorie)->libelle }}</td>
                                    <td>{{ $item->prixV }}</td>
                                    <td>{{ App\User::findOrFail($item->idemploye)->name }}</td>
                                    <td>{{ App\Client::findOrFail($item->idclient)->name }}</td>
                                    <td>{{ $item->created_at->format('d/m/y H:i') }}</td>
                                </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  </section>
  
  <script>
      function aprescliquement(){
          
    document.getElementById("aremplacer").style.display = 'none';
    document.getElementById("boum").style.display = 'block';
    
    
    // document.getElementById("testclique").href = '../print/find/?user='+document.getElementById("se").value+'?date='+document.getElementById("se").value;

    
    
    var doughnutData = [{
        value: 60,
        color: "#1c9ca7"
      },
      {
        value: 40,
        color: "#f68275"
      }
    ];
    var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);

    }
  </script>
@endsection