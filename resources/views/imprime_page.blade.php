
<!DOCTYPE html>
<html dir="ltr" lang="fr">

<head>
    <title>izyStock | Facture </title>
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
			<h1><center>{{ App\Boutique::first()->nomEtablissement }}</center></h1>
			<div style="float: right; font-size: 10px;"> {{ App\Annexe::findOrFail(Auth()->User()->idannexe)->nomAnnexe }}</div><br>
		</div>
		
		<br>
		<?php 
			$lesventes = App\Vente::whereIdfacture($lafacture->id)->get();
		 ?>
		<div class="col-12">
			<span><b>Facture</b> : 0000000{{ $lafacture->id}} </span>
			<span style="float: right;"><b>Client</b> : {{ App\Client::findOrfail($lafacture->idclient)->name}} </span>
		</div>
		<br>
		<div class="col-12">
			<span><b>Date de payement :  </b></span>
			<span style="float: right;">{{ $lafacture->created_at->format("d/m/Y H:i") }}</span>
		</div>
		<br>
		<br>		
		<br>
		<div>
			<hr>
			
		</div>
		<div class="col-12">
			<span><b>Qte  </b></span>
			<span><b>Désignation</b></span>
			<span style="float: right;"><b>Montant </b></span>
		</div>
		<hr>
		<br>
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
				<div><b>Montant a payer </b> : {{ $lafacture->montant }}</div>
				<div><b>Montant solder</b> : {{ $lafacture->montant }}</div>
			</div>
		</div>
		
			
		<br>
		
	</div>
	<div class="col-12" style="margin-top: 50px;">
			<i>Facture imprimee par : </i>
			<br>
			<br>
			<div style="font-size: 4px;">(Signature et cachet de l'entreprise)</div>
			<br>
			<br>
			{{ Auth()->User()->name }}
			<br>
			<b>{{ Auth()->User()->typeUtilisateur }}<b>
		</div>
	<footer style="text-align: right; font-size: 8px; position: absolute; bottom: 0;">
        <center>IzyStock | All Rights Reserved. Designed and Developed whith ♥ by FunCode's . Contacts : 0022996631611 | WhatsApp : 0040736141740 </center>
    </footer>

</body>

</html>
        