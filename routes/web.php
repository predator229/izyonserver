<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//deconnexion
Route::get('/logOut', 'HomeController@logOut')->name('logOut');

//profile
Route::get('/profile', 'HomeController@profile')->name('profile');


//liste des produits
Route::get('/products/allProduct', 'HomeController@allProduct')->name('allProducts');

//nouveau produit
Route::get('/products/newProduct', 'HomeController@newProduct')->name('newProduct');

//nouveau produit
Route::get('/products/approvisionnement/newApprovisonnement', 'HomeController@newApprovisonnement')->name('newApprovisonnement');


//liste des categories des produits
Route::get('/products/allCategorie', 'HomeController@allCategorie')->name('allCategorie');


//fiche technique du produit
Route::get('/products/fichetechnique/{id}', 'HomeController@fichetechnique');


//fiche technique de la categorie
Route::get('/products/fichecategorie/{id}', 'HomeController@fichecategorie');


//ajouter une categories de produits
Route::post('/products/addCategorie', 'HomeController@addCategorie');

//ajouter une approvisonnement de produits
Route::post('/products/addApprovisionnement', 'HomeController@addApprovisionnement');

//ahouter des produits
Route::post('/products/newProductSave', 'HomeController@newProductSave');

//ajouter une approvisonnement de produits
Route::get('/stocks', 'HomeController@stocks');

//ajouter un produits
Route::get('/nouveauClient', 'HomeController@client');

//ajouter une approvisonnement de produits
Route::get('/products/vente/nouvelleVente', 'HomeController@nouvelleVente')->name('venteNouvelle');

//ahouter des produits
Route::post('/products/vente/fichevente', 'HomeController@fichevente');

//ahouter des produits
Route::get('/products/vente/ficheventeGros', 'AutreController@ficheventeGros')->name('ficheventeGros');

//ajouter au panier
Route::post('/products/vente/storeInPanier/{id}', 'HomeController@storeInPanier');

//editer le panier
Route::post('/products/vente/fichevente/edit/{id}', 'HomeController@ficheventeEdit');

//supprimer le panier
Route::get('/products/vente/fichevente/delete/{id}', 'HomeController@ficheventeDelete');

//liste des factures
Route::get('/products/facture/liste', 'HomeController@listeFactures');

//aller a la facture
Route::get('/products/vente/fichevente/facturation/', 'HomeController@facturation');

Route::post('/products/vente/fichevente/facturation/', 'HomeController@facturationClient02');

//enregistrer clientfacturation
Route::post('client/new/facturation', 'HomeController@facturationClient');

//enregistrer clientfacturation
Route::post('client/new/default', 'HomeController@saveClient');

//save la facture
Route::get('/products/vente/fichevente/facturation/save/{id}', 'HomeController@facturationSave');

//print la facture
Route::get('/facturation/print/{id}', 'HomeController@printFacture');


//profil
Route::get('/user/profil', 'HomeController@profil');
Route::get('/profile', 'HomeController@profil');

//modifier photo de profil
Route::post('/user/updatee', 'AutreController@update');
Route::post('/user/updatee/info', 'AutreController@modifInfo');
Route::post('/user/updatee/pass', 'AutreController@changerPass');
Route::post('/user/desactivation/{id}', 'AutreController@deleteUser');

//tous les utilisateurs
Route::get('/reglage/personnelplus', 'AutreController@profilAll')->name('tousUtilisateurs');

//ajouter un utilisateur
Route::get('/regale/user/addnewuser', 'AutreController@newuser');

//validation
Route::post('/reglage/user/addnewuserSave', 'AutreController@createUser');

//reglage de base
Route::get('/reglage/reglagebase', 'AutreController@reglagebase');
Route::post('/reglage/updatee/info', 'AutreController@modifReglageInfo');
Route::get('/personnel/ressuscite/admin/{id}', 'AutreController@ressucitation');
Route::get('/locks', 'AutreController@locks');


//point journalier
Route::get('/facturation/journ/{id}', 'AutreController@printPointJr');
Route::post('/facturation/byday/{id}', 'AutreController@printPointByDay');
Route::get('/facturation/total/{id}', 'AutreController@printPoint');
Route::get('/print/allsell', 'AutreController@printallsell');
Route::get('/print/find', 'AutreController@test');
Route::get('/print/findMonth', 'AutreController@findMonth');
Route::get('/print/findBetween', 'AutreController@findBetween');
Route::get('print/user/{id}', 'AutreController@test2');

// Route::post('/print/find', 'AutreController@printfind');


//registre
Route::get('/registres/sorties', 'AutreController@registreVente');
Route::get('/registres/users', 'AutreController@registreusers');
