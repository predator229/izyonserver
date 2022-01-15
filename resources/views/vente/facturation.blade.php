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
    
    <section class="wrapper">
      <div class="col-lg-12 mt">
        <div class="row content-panel">
          <div class="col-lg-10 col-lg-offset-1">
            <div class="invoice-body">
              
              <!-- /pull-right -->
              <div class="clearfix"></div>
              
              <div class="row">
                <div class="col-md-9">
                @if (!isset($clicli))
                <form action="{{ asset('products/vente/fichevente/facturation/') }}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="">Selectionner ou ajouter le client</label>
                  <div class="row">
                    <div class="col-md-4 col-xs-8">
                      <select name="client" id="" class="form-control">
                        {{ $clients = App\Client::all() }}
                        @foreach ($clients as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                          
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2">
                      <a data-toggle="modal" href="#clientnew" class="btn btn-default"><i class="fa fa-plus"></i></a>
                    </div>
                    @if (App\Client::count() != 0)
                    <div class="col-md-2 ">
                      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i></button>
                    </div>
                    @endif
                  
                  </div>
                </div>
                </form>
                @else
                <h4>{{ $clicli->name }} <a href="{{ asset('products/vente/fichevente/facturation/') }}"><i class="fa fa-refresh"></i></a></h4>
                @endif
                  {{--  --}}
                  <address>
                    <strong>{{ App\Boutique::first()->nomEtablissement }} {{ App\Annexe::all()->count() == 1 ? "" : App\Annexe::findOrFail(Auth()->User()->idannexe)->nomAnnexe }}</strong><br>
                    {{ App\Annexe::findOrFail(Auth()->User()->idannexe)->nomAnnexe }}<br>
                    <abbr title="Phone">P:</abbr> (229) {{ App\Annexe::findOrFail(Auth()->User()->idannexe)->nomAnnexe }}
                  </address>
                </div>
                <!-- /col-md-9 -->
                <?php $panier = Gloudemans\Shoppingcart\Facades\Cart::content(); ?>
                <div class="col-md-3">
                  <br>
                  <div>
                    <div class="pull-left"> FACTURE No : </div>
                    <div class="pull-right"> 000283 </div>
                    <div class="clearfix"></div>
                  </div>
                  <div>
                    <!-- /col-md-3 -->
                    <div class="pull-left"> DATE DE VENTE : </div>
                    <div class="pull-right"> 15/03/14 </div>
                    <div class="clearfix"></div>
                  </div>
                  <!-- /row -->
                  <br>
                  <div class="well well-small green">
                    <div class="pull-left"> Total Due : </div>
                    <div class="pull-right"> {{ Gloudemans\Shoppingcart\Facades\Cart::subtotal() }} </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <!-- /invoice-body -->
              </div>
              <!-- /col-lg-10 -->
              <div class="table-responsive table-bordered no-border">
                <table class="table table-responsive table-bordered no-border">
                    <thead>
                      <tr>
                        <th style="width:60px" class="text-center">QTE</th>
                        <th class="text-left">DESCRIPTION</th>
                        <th style="width:140px" class="text-right">UNIT PRICE</th>
                        <th style="width:90px" class="text-right">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($panier as $item)
                    <tr>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-right">{{ $item->price }}</td>
                        <td class="text-right">{{ $item->qty * $item->price}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
              </div>
              <div class="row">                
                  <div class="col-xs-12">
                    <div class=" no-border">
                        <div class="text-right"><strong>Total : </strong><strong>{{ Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}  XOF</strong></div>
                    </div>
                  </div>
              </div>
              
              @if (isset($clicli))
              <br>
              <br>
              <div class="row">
                <div class="col-xs-7"></div>
                <div class="col-xs-5">
                  <a href="{{ asset('products/vente/fichevente/facturation/save/'.$clicli->id) }}" class="btn btn-block btn-danger"><i class="fa fa-download"></i>Confirmer vente et <i class="fa fa-print"></i> Imprimer la facture</a>
                </div>
              </div>
              @endif
              <br>
              <br>
            </div>

            <div aria-hidden="true" aria-labelledby="client-new" role="dialog" tabindex="-1" id="clientnew" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" >
                      <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Nouveau client ?</h4>
                    </div>
                    <form action="{{ asset('/client/new/facturation') }}" method="post">
                        {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="qte">Entrer le nom du client</label>
                            <input type="text" class="form-control" name="name" id="qte" required>
                        </div>
                        <div class="form-group">
                            <label for="qte">Entrer le telephone du client</label>
                            <input type="text" class="form-control" name="tel" id="qte" required >
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                      <input type="submit" value="Enregister le client" class="btn btn-success">
                    </div>
                    </form>
                  </div>
                </div>
                
            </div>
            <!--/col-lg-12 mt -->
    </section>
    <!-- /wrapper -->
@endsection