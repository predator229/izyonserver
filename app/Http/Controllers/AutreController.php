<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use  App\CategorieProduit;

use  App\Approvisonnement;

use  App\Stock;

use  App\Produit;

use  App\User;

use  App\Boutique;

use  App\Annexe;

use  App\Client;

use  App\Vente;

use  App\Facture;

use  Carbon\Carbon;

use PDF;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Hashing\BcryptHasher;
// use Illuminate\Facade\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class AutreController extends Controller
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
    public function update (Request $request){
        // $this->validate($request, [
        //     'cheminImage' => 'required'
        // ]);

        $nomImage = Auth()->User()->name."_".Carbon::now()."_".str_random(10);
        request()->cheminImage->move(public_path('/img/profil'), ''.$nomImage);

        $legar = User::findOrFail(Auth()->User()->id);
        $legar->update([
            'cheminImage' => 'img/profil'.$nomImage
        ]);

        return redirect()->back();
    }

    public function modifInfo(Request $request){
        $legarf = User::findOrFail(Auth()->User()->id);

        $legarf->update([
            'name' => $request->name,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone
        ]);

        return redirect()->back();
    }

    public function modifReglageInfo(Request $request){
        $legarf = Boutique::findOrFail(Annexe::findOrFail(Auth()->User()->idannexe)->idEtablissement);

        $legarf->update([
            'nomEtablissement' => $request->name,
            'adresseEtablissement' => $request->adresse,
            'telephoneEtablissement' => $request->telephone
        ]);

        return redirect()->back();
    }
    

    public function changerPass(Request $request){
        $legarf = User::findOrFail(Auth()->User()->id);

        if ($request->newmdp != $request->confirmnewmdp) {
            $erreurpass = 'Les mots de passe entres sont differents';
            return redirect()->back()->withErrors($erreurpass);
        }

        if (Hash::make($request->ancienpass) != Auth()->User()->password) {
            $erreurpass = 'Mauvais mot de passe'.Hash::make($request->ancienpass);
            return redirect()->back()->withErrors($erreurpass);
        }
        

        if (Hash::make($request->ancienpass) != Auth()->User()->password && $request->newmdp != $request->confirmnewmdp) {
            $legarf->update([
                'password' => Hash::make($request->newmdp)
            ]);

            Auth::logout();
            return redirect()->route('login');
        }
        

        return redirect()->back();

    }

    public function profilAll()
    {
        return view('user.alluser');
    }

    public function ficheventeGros()
    {
        return view('lefichedesvente');
    }

    public function newuser()
    {
        return view('user.newuser');
    }
    
    protected function createUser(Request $data)
    {
        
        $this->validate($data, [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($data->image == ''){
            User::create([
                'adresse' => $data->adresse,
                'telephone' => $data->telephone,
                'typeUtilisateur' => $data->typeUtilisateur,
                'name' => $data->prenom.' '.$data->nom,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'idannexe' => Auth()->User()->idannexe,
            ]);
        }
        else {
            $path =  $data->file('image')->store('img/profil');
            // $path = $request->file('imageproduit')->store('produits/'.Auth()->User()->name);

            User::create([
                'adresse' => $data->adresse,
                'telephone' => $data->telephone,
                'typeUtilisateur' => $data->typeUtilisateur,
                'name' => $data->prenom.' '.$data->nom,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'idannexe' => Auth()->User()->idannexe,
                'cheminImage' => 'storage/app/'.$path,
            ]);
        }

        return redirect()->route('tousUtilisateurs');
    }

    public function reglagebase(){
        return view('reglagebase');
    }

    public function deleteUser(Request $request, $id){

        $luti = User::findOrFail($id);

        $luti->update([
            'delete' => 'oui',
            'password' => $luti->password.'2020',
            'email' => $luti->email.'2020',
            'delet_motif' => $request->motif,
        ]);
        return back();
    }

    public function ressucitation($id){
        
        $luti = User::findOrFail($id);



        $mp = $luti->password;
        $lemot = '';
        for ($i=0; $i < strlen($mp) - 4; $i++) { 
            # code...
            $lemot = $lemot.''.$mp[$i];
        }

        $mpe = $luti->email;
        $lemote = '';
        for ($i=0; $i < strlen($mpe) - 4; $i++) { 
            # code...
            $lemote = $lemote.''.$mpe[$i];
        }

        $luti->update([
            'delete' => 'no',
            'password' => $lemot,
            'email' => $lemote,
            'delet_motif' => 'Pas supprimer',
        ]);
       
        // substr($mp, 0, strlen($mp) - 7)
        return back();
    }

    function printPointJr($id){
        
        // $datee = Carbon::now();
            $levendeur = User::findOrfail($id);
            $pdf = PDF::loadView('vente.factures_models.jouvente', compact('levendeur'));
            $name = Boutique::first()->nomEtablissement.'_point_journalier'.User::findOrfail($id)->name.'_'.Carbon::now().'.pdf';
            //return $pdf->stream();
            return $pdf->download($name);
            // return ('dd');
    }

    function printPoint($id){
        
        // $datee = Carbon::now();
            $levendeur = User::findOrfail($id);
            $pdf = PDF::loadView('vente.factures_models.toutesmesventes', compact('levendeur'));
            $name = Boutique::first()->nomEtablissement.'_point_total'.User::findOrfail($id)->name.'_'.Carbon::now().'.pdf';
            //return $pdf->stream();
            return $pdf->download($name);
            // return ('dd');
    }

    function printPointByDay($id, Request $request){
        
        // $datee = Carbon::now();
            $levendeur = User::findOrfail($id);
            $date = $request->date;
            $pdf = PDF::loadView('vente.factures_models.pointjour', compact('levendeur', 'date'));
            $name = Boutique::first()->nomEtablissement.'_point_du_'.$date.'_'.User::findOrfail($id)->name.'_'.Carbon::now().'.pdf';
            //return $pdf->stream();
            return $pdf->download($name);
            // return ('dd');
    }

    public function locks(){
        // $photo = Auth()->User()->cheminImage;
        // $email = Auth()->User()->email;
        // Auth::logout();
        return view('locks');
   }
   
   public function registreVente(){
    // $photo = Auth()->User()->cheminImage;
    // $email = Auth()->User()->email;
    // Auth::logout();
        return view('registres.vente');
    }

    
   public function registreusers(){
    // $photo = Auth()->User()->cheminImage;
    // $email = Auth()->User()->email;
    // Auth::logout();
        return view('registres.user');
    }
  
    function printallsell(){
            
        // $datee = Carbon::now();
            // $levendeur = User::findOrfail($id);
            // $date = $request->date;
            $pdf = PDF::loadView('vente.factures_models.toutesventes');
            $name = Boutique::first()->nomEtablissement.'_toutes_les_ventes_'.Carbon::now().'.pdf';
            //return $pdf->stream();
            return $pdf->download($name);
            // return ('dd');
    }

    

    function printfind(Request $request){
            
        // $datee = Carbon::now();
            $levendeur = User::findOrfail($request->date);
            $date = $request->date;
            $pdf = PDF::loadView('vente.factures_models.pointjour', compact('levendeur', 'date'));
            $name = Boutique::first()->nomEtablissement.'_recherche_du_'.$date.'_et_de_'.User::findOrfail($id)->name.'_'.Carbon::now().'.pdf';
            //return $pdf->stream();
            return $pdf->download($name);
            // return ('dd');
    }

    function test (){
        $pdf = PDF::loadView('vente.factures_models.findbyidanddate');
        $name = Boutique::first()->nomEtablissement.'_recherche_du_speciale de '.Carbon::now().'.pdf';
        //return $pdf->stream();
        return $pdf->download($name);
    }
    
    function findMonth (){
        $pdf = PDF::loadView('vente.factures_models.findbyidanddateMonth');
        $name = Boutique::first()->nomEtablissement.'inventaire_'.$_GET['date'].'.pdf';
        //return $pdf->stream();
        return $pdf->download($name);
    }
    function findBetween (){
        
        // return $lesventes = Facture::whereBetween('created_at', [$_GET['date1'], $_GET['date2']])
                                            // ->get();
        
        $pdf = PDF::loadView('vente.factures_models.findBetween');
        $name = Boutique::first()->nomEtablissement.', Inventaire_personalisee entre le '.$_GET['date1'].'et le'.$_GET['date2'].'.pdf';
        //return $pdf->stream();
        return $pdf->download($name);
    }
    
    
    function test2 ($id){
        $pdf = PDF::loadView('vente.factures_models.findbyid', compact('id'));
        $name = Boutique::first()->nomEtablissement.'_recherche_par utilisateur de '.Carbon::now().'.pdf';
        //return $pdf->stream();
        return $pdf->download($name);
    }
}
