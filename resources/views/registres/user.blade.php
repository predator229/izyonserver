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
    <li class=""><a class="" href="{{ asset('registres/sorties') }}"> Registre des vente</a></li>
    {{-- @if (Auth()->User()->typeUtilisateur == 'AdminSysteme' || Auth()->User()->typeUtilisateur == 'Gerant') --}}
    <li class="active"><a class="" href="{{ asset('registres/users') }}"> Registre utilisateurs</a></li>
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
        
        <div class="row">
            <h6>Toutes utilisateurs</h6>
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
                            <th><center> Nom du vendeur</center></th>
                            <th><center> Nombre de vente </center></th>
                            <th><center> Date d'inscription</center></th>
                            <th><center> Montant total vendu à ce jour </center></th>
                            <th><center><i class="fa fa-print text-danger text-center"></i></center></th>
                        </thead>
                        <tbody>
                            @php
                                $collection = App\User::where('idannexe', Auth()->User()->idannexe)->where('typeUtilisateur', '!=', 'AdminSysteme')->get();
                                
                            @endphp
                            @foreach ($collection as $item)
                                @php
                                    $total = 0;
                                    $nbrevente = 0;
                                    $collections = App\Facture::where('idemploye', $item->id)->get();

                                @endphp
                                @foreach ($collections as $items)
                                    @php
                                        $total += $items->montant;
                                        $nbrevente += 1;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td><center>{{ $item->name }}</center></td>
                                    <td><center>{{ $nbrevente }}</center></td>
                                    <td><center>{{ $item->created_at->format('d/m/yy H:i:s') }}</center></td>
                                    <td><center>{{ $total }} XOF</center></td>
                                    <th><center><a href="{{ asset('print/user/'.$item->id)}}"><i class="fa fa-print text-danger text-center"></i></a></center></th>
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