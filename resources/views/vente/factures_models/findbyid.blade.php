
<!DOCTYPE html>
<html dir="ltr" lang="fr">

<head>
    <title>izyStock | Point </title>
    <!-- Custom CSS -->

</head>

<body>
	<div class="container">
		
		<div style="display: inline-block; font-size: 6px; float: right;">
			<span style="font-size:10px;">
				{{ App\Boutique::all()->first()->adresseEtablissement }} |
				{{ App\Boutique::all()->first()->telephoneEtablissement }} |
				{{ App\Annexe::findOrFail(Auth()->User()->idannexe)->telephoneAnnexe }}</span>
			<span style=" margin: 10px">
				{{ Carbon\Carbon::now() }}
			</span>
		</div>
		<div class="text-center col-12">
			<h1><center>{{ App\Boutique::first()->nomEtablissement }}  <span style="font-size: 8px;">( {{ App\Annexe::findOrFail(Auth()->User()->idannexe)->nomAnnexe }} )</span>  </center></h1>
			<div style="float: right; font-size: 15px;"> <b>Point journalier </b> </div><br>
        </div>
		<hr>
        <br>
        <?php 
                $lesventes = App\Facture::where('idemploye', $id)
                                            // ->where( 'created_at', '>', date("d/m/yy"))
                                            ->get();
            
            $nbrevente = 0;
            $total = 0;
         ?>
        @foreach ($lesventes as $item)
            {{-- @if ($item->created_at->format('d/m/yy') == $_GET['date'] ) --}}
                
                <?php $total += (float)$item->montant;
                      $nbrevente += 1;
                ?>
                
            {{-- @endif --}}
        @endforeach
		<div class="col-12">
			<span><center><b>  Vendeur</b> : {{ App\User::findOrFail($id)->name}} </center></span>
			{{-- <span style="float: right;"><b>Date</b> : {{ $_GET['date'] }} </span> --}}
        </div>
        <br>
        <div class="col-12">
			<span><b>Nombre de vente</b> : {{ $nbrevente}} </span>
			<span style="float: right;"><b>Recette totale</b> : {{ $total }} FCFA </span>
        </div>
        <br>
        <div><center> <b>Détails</b> </center></div>
		
        <br>
        <hr>
		<div class="col-12">
			{{-- <span><b>Qte  </b></span> --}}
			<span><b>Client</b></span>
			<span style="float: right;"><b>Montant </b></span>
        </div> <hr><br>
        @foreach ($lesventes as $item)
            {{-- @if ($item->created_at->format('d/m/yy') == $_GET['date']) --}}
                
                <div class="col-12">
                    {{-- <span><b>Qte  </b></span> --}}
                    <span>{{ App\Client::findOrFail($item->idclient)->name }}</b></span>
                    <span style="float: right;">{{ $item->montant }}</span>
                </div> 
                <br>
            {{-- @endif --}}
        @endforeach
        <br>
        <hr>
        <div class="col-12">
            {{-- <span><b>Qte  </b></span> --}}
            <span></b></span>
            <span style="float: right;"><b>{{ $total }}</b></span>
        </div> 
        <br>
        <br>
        <br>
        <div><center> <b>Plus de détails</b> </center></div>
        <br>
        @php
            $toutesventes = App\Vente::where('idemploye', $id)->get();

            
        @endphp
        <div>
            <table style="border-collapse: collapse;">
                <tr>
                    <th style="border: 1px solid black; padding: 10px:">Qté</th>
                    <th style="border: 1px solid black; padding: 10px:">Produit</th>
                    <th style="border: 1px solid black; padding: 10px:">Catégorie</th>
                    <th style="border: 1px solid black; padding: 10px;">Montant</th>
                    {{-- {!! $_GET['user'] == 0 ? '<th style="border: 1px solid black; padding: 10px;">Vendeur</th>': '' !!} --}}
                    <th style="border: 1px solid black; padding: 10px;">Client</th>
                    <th style="border: 1px solid black; padding: 10px;">Date et heure</th>
                    <th style="border: 1px solid black; padding: 10px;">Payer ?</th>
                </tr>
                <tbody>
                    @foreach ($toutesventes as $item)
                        {{-- @if ($item->created_at->format('d/m/yy') == $_GET['date'] ) --}}
                            <tr>
                                <td style="border: 1px solid black; padding: 10px;">{{ $item->qte }}</td>
                                <td style="border: 1px solid black; padding: 10px;">{{ App\Produit::findOrFail($item->idproduit)->libelle }}</td>
                                <td style="border: 1px solid black; padding: 10px;">{{ App\CategorieProduit::findOrFail(App\Produit::findOrFail($item->idproduit)->idcategorie)->libelle }}</td>
                                <td style="border: 1px solid black; padding: 10px;">{{ $item->prixV }}</td>
                                {{-- {!! $_GET['user'] == 0 ? '<td style="border: 1px solid black; padding: 10px;">'.App\User::findOrFail($item->idemploye)->name.'</td>' : '' !!} --}}
                                <td style="border: 1px solid black; padding: 10px;">{{ App\Client::findOrFail($item->idclient)->name }}</td>
                                <td style="border: 1px solid black; padding: 10px; ">{{ $item->created_at->format('d/m/y H:i') }}</td>
                                <th style="border: 1px solid black; padding: 10px;">Oui</th>
                            </tr>
                        {{-- @endif --}}
                    @endforeach
                    <tr>
                        <td  colspan="6"><b>TOTAL : </b></td>
                        <td style="border: 1px solid black; padding: 10px; " ><b>{{ $total }}</b></td>

                    </tr>
                </tbody>
            </table>
            </div>

            <br>
        <br>
        <br>
        {{-- <br>
			@foreach($lesventes as $loc)
				<div class="col-12">
				<span> {{$loc->qte }}</span>
				<span style="padding-left: 10px;"> {{ App\Produit::findOrFail($loc->idproduit)->libelle }}
				</span>
					<span style="float: right;">{{ $loc->prixV * $loc->qte }}</span>
				</div>
				<br>
			@endforeach
			<br>
			
			 <!-- {{ $lafacture->montant }} -->
		<div style="float: right;"><b>{{ $lafacture->montant }}</b></div>
		<br>

		<div>
			<hr>
		</div>
		<div class="col-12">
			<div style="float: left;">
				<div><b>Facture enregistrée par</b> : </div>
				<div>{{ App\User::findOrFail($lafacture->idemploye)->name }}</div>
				
			</div>
			<div style="float: right;">
				<div><b>Total</b> : {{ $lafacture->montant }}</div>
				
			</div>
		</div>
		
			
		<br>
		<div style="margin-top: 250px; float: right;">
			
			<i>{{ Auth()->User()->name }}</i>
		</div>
	</div> --}}

	<footer style="text-align: right; font-size: 8px; position: absolute; bottom: 0;">
        <center><div>IzyStock | All Rights Reserved. Designed and Developed whith ♥ by FunCode's . Contacts : 0022996631611 | WhatsApp : 0040736141740 </div></center>
    </footer>

</body>

</html>
        