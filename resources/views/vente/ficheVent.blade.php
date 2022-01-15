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
           
            <?php $verif=false; ?>
            <div class="content-panel">
                <div class="container-fluid">
                    <div class="col-md-10">                    
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-block btn-default" href="{{ asset('products/vente/nouvelleVente') }}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    
                  
                        <div class="row">
                          
                              <div class="custom-box">
                                <div class="servicetitle">
                                  <h4>Detail de la vente</h4>
                                  <hr>
                                </div>
                                <div class="table-responsive table-bordered">
                                  <table class=" table table-responsive table-bordered" >
                                    <thead>
                                      <th class="">Produit</th>
                                      <th class="text-center">Qte</th>
                                      <th class="text-center">Prix</th>
                                      <th class="text-center">Option</th>
                                    </thead>
                                    <?php $panier = Gloudemans\Shoppingcart\Facades\Cart::content(); ?>
                                    <tbody>
                                        @foreach ($panier as $item)
                                        <tr>
                                            <th class="">{{ $item->name }}</th>
                                        <th class="text-center">{{ $item->qty }}</th>
                                        <th class="text-center">{{ $item->price }}</th>
                                        <th class="text-center">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <a data-toggle="modal" href="#edit-{{ $item->rowId }}" class="text-primary"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="col-xs-6">
                                                    <a href="{{ asset('/products/vente/fichevente/delete/'.$item->rowId) }}" class="text-danger"><i class="glyphicon glyphicon-trash"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <div aria-hidden="true" aria-labelledby="edit-{{ $item->rowId }}" role="dialog" tabindex="-1" id="edit-{{ $item->rowId }}" class="modal fade">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header" >
                                                  <button type="button" class="close text-light" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <h4 class="modal-title">Modification ?</h4>
                                                </div>
                                                <form action="{{ asset('/products/vente/fichevente/edit/'.$item->rowId) }}" method="post">
                                                    {{ csrf_field() }}
                                                <div class="modal-body">
                                                  <div class="form-group">
                                                      <label for="qte">Entrer la quantite souhaite</label>
                                                      <input type="number" class="form-control" name="qte" id="qte" required min="1" value="{{ $item->qty }}">
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                                  <input type="submit" value="Enregister la modification" class="btn btn-success">
                                                </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                        </tr>
                                        @endforeach
                                        @if ($panier->count() == 0)
                                            <tr>
                                                <td colspan="4"><div class="text-center text-danger">( Aucun produit en vente )</div></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                  </table>
                                </div>
                                <div class="icn-main-container">
                                    <hr>
                                  <span class="icn-container" style="font-size: 10px"><?php echo Gloudemans\Shoppingcart\Facades\Cart::subtotal() ?> XOF</span>
                                </div>
                                @if ($panier->count() != 0)
                                    <tr>
                                        <a class="btn btn-warning" href="{{ asset('/products/vente/fichevente/facturation/') }}">Facturation <i class="fa fa-arrow-circle-o-right"></i></a>
                                    </tr>
                                @endif
                              </div>
                         
                        </div>
                        
                </div>
            </div>
            
        </div>
        
    </div>

    <script>

    //   
    

    </script>
  </section>
@endsection