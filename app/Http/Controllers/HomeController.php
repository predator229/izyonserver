<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use  App\CategorieProduit;

use  App\Approvisonnement;

use  App\Stock;

use  App\Produit;

use  App\Client;

use  App\Vente;

use  App\Facture;
use Carbon\Carbon;

use PDF;

use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home1');
    }

    public function allProduct()
    {
        return view('produits/index');
    }

    public function newProduct()
    {
        return view('produits/newProduct');
    }

    
    public function newApprovisonnement()
    {
        return view('produits/appro/approNew');
    }

    public function stocks()
    {
        return view('stocks');
    }

    public function nouvelleVente()
    {
        return view('vente/newvente');
    }


    public function allCategorie()
    {
        return view('produits/categorie/index');
    }

    public function addCategorie(Request $request)
    {
        $exist = CategorieProduit::whereLibelle($request->libelle);
        $exist = $exist->where('idannexe', Auth()->User()->idannexe);
        if (! $exist->first()) {
        
            CategorieProduit::create([
                'libelle' => $request->libelle,
                'idannexe' => Auth()->User()->idannexe
            ]);
        }

        return back();
    }

    public function addApprovisionnement(Request $request)
    {
    
        Approvisonnement::create([
            'idproduit' => $request->idproduit,
            'nbre' => $request->nbre,
            'idannexe' => Auth()->User()->idannexe,
            'idemploye' => Auth()->User()->id
        ]);

        $leproduit = Stock::whereIdannexeAndIdproduit(Auth()->User()->idannexe, $request->idproduit)->get();

        if($leproduit->first()){

            $nbre = $leproduit->first()->nbre;
            $leproduit->first()->update([
                'nbre' => $nbre + $request->nbre,
            ]);
        
        }
        else {
            Stock::create([
                'idproduit' => $request->idproduit,
                'nbre' => $request->nbre,
                'idannexe' => Auth()->User()->idannexe,
            ]);
        }

        return back();
    }

    public function newProductSave(Request $request)
    {
        $exist = Produit::whereLibelle($request->libelle);
        $exist = $exist->where('idannexe', Auth()->User()->idannexe);
        $exist = $exist->where('idcategorie', $request->idannexe);
        $exist = $exist->where('prix', $request->prix);
        $exist = $exist->where('seuil', $request->seuil);
        $exist = $exist->where('description', $request->description);
        if (! $exist->first()) {
        
            if ($request->imageProduit == "") {

                $path = 'img/produits/dafaultImageProduit.png';
            }
            else {
                $path =  $request->file('imageProduit')->store('img/produit');

            }

            Produit::create([
                'libelle' => $request->nom,
                'idcategorie' => $request->categorie,
                'description' => $request->description,
                'prix' => $request->prix,
                'seuil' => $request->seuil,
                'imageProduit' => 'storage/app/'.$path,
                'idannexe' => Auth()->User()->idannexe
            ]);

            Approvisonnement::create([
                'idproduit' => Produit::all()->last()->id,
                'nbre' => $request->quantite,
                'idannexe' => Auth()->User()->idannexe,
                'idemploye' => Auth()->User()->id
            ]);

            Stock::create([
                'idproduit' => Produit::all()->last()->id,
                'nbre' => $request->quantite,
                'idannexe' => Auth()->User()->idannexe,
            ]);
        }

        return back();
    }

    public function fichetechnique($id)
    {
        return view('produits/fiche', compact('id'));
    }

    public function fichecategorie($id)
    {
        return view('produits/categorie/fichecategorie', compact('id'));
    }

    public function fichevente( Request $request)
    {
        $id = $request->produit;
        return view('vente/newVentee', compact('id'));
    }

    public function ficheventeGros()
    {
        return view('vente/fichevente');
    }
    
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function storeInPanier($id, Request $request)
    {
        Cart::add($id, CategorieProduit::findOrFail(Produit::findOrFail($id)->idcategorie)->libelle.' '.Produit::findOrFail($id)->libelle , $request->qteVendu , $request->subtot / $request->qteVendu );
        
        return redirect()->route('ficheventeGros');
    }

    public function ficheventeEdit($id, Request $request)
    {
        Cart::update($id, ['qty' => $request->qte]);
        
        return redirect()->route('ficheventeGros');
    }
    
    public function ficheventeDelete($id)
    {
        Cart::remove($id);
        
        return redirect()->route('ficheventeGros');
    }

    public function facturation()
    {
       
        return view('vente/facturation');
    }

    public function facturationClient(Request $request)
    {
        $exist = Client::whereNameAndTel($request->name, $request->tel)->get();

        if(! $exist->first())
        {
            Client::create([
                'name' => $request->name,
                'tel' => $request->tel,
            ]);
        }

        $clicli = Client::all()->last();
        return view('vente/facturation', compact('clicli'));
    }
    public function saveClient(Request $request)
    {
        $exist = Client::whereNameAndTel($request->name, $request->tel)->get();

        if(! $exist->first())
        {
            Client::create([
                'name' => $request->name,
                'tel' => $request->tel,
            ]); 
        }

       return redirect()->back();
    }

    public function facturationClient02(Request $request)
    {
        $clicli = Client::findOrFail($request->client);
        return view('vente/facturation', compact('clicli'));
    }

    public function listeFactures()
    {        
        return view('listeFactures');
    }
    

    

    public function facturationSave($id)
    {

        if (Cart::count() !=0) {
            # code...

            $calcul = Cart::content();

            $total = 0;

            foreach ($calcul as $item) {
                # code...
                $total += $item->qty * $item->price;
            }

            Facture::create([
                'idclient' => $id,
                'montant' => $total,
                'idemploye' => Auth()->User()->id,
                'idannexe' => Auth()->User()->idannexe
            ]);
    
            $ledatail = Cart::content();
            foreach ($ledatail as $item) {
                Vente::create([
                    'idclient' => $id,
                    'idproduit' => $item->id,
                    'qte' => $item->qty,
                    'prixV' => $item->price,
                    'idfacture' => Facture::all()->last()->id,
                    'idemploye' => Auth()->User()->id,
                    'idannexe' => Auth()->User()->idannexe
                ]);
                # code...
                $lestock = Stock::whereIdproduit($item->id)->get()->first();
    
                if ($lestock) {
                    # code...
                    $lestock->update([
                        'nbre' => $lestock->nbre - $item->qty
                    ]);
                }
            }

            Cart::destroy();
            
            $lafacture = Facture::all()->last();
            $pdf = PDF::loadView('imprime_page', compact('lafacture'));
            $name = 'facture_client_'.Carbon::now().'_'.$lafacture->id.'.pdf';
            $pdf->stream();
            $pdf->download($name);
        }

        return redirect()->route('venteNouvelle');
    }

    function client(){
        return view('client/nouveauClient');
    }

    function profil(){
        return view('user/profil');
    }

    function printFacture($id){
        
        // $datee = Carbon::now();
            $lafacture = Facture::findOrfail($id);
            $pdf = PDF::loadView('imprime_page', compact('lafacture'));
            $name = 'facture_client_'.Client::findOrFail($lafacture->idclient)->name.'_'.Carbon::now().'.pdf';
            //return $pdf->stream();
            return $pdf->download($name);
            // return ('dd');
    }

     
}
