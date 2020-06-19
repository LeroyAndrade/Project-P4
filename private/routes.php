<?php

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace( 'Website\Controllers' );

SimpleRouter::group( [ 'prefix' => site_url() ], function () {

	// START: Zet hier al eigen routes
	// Lees de docs, daar zie je hoe je routes kunt maken: https://github.com/skipperbent/simple-php-router#routes


	//Basis url
		SimpleRouter::get( '/', 'WebsiteController@home' )->name( 'home' );
	//registreer routes
		SimpleRouter::get( '/registreer', 'RegistreerController@registreerForm' )->name( 'registreer.form' );
		SimpleRouter::post( '/registreer/verwerken', 'RegistreerController@VerwerkRegistreerForm' )->name( 'registreer.verwerk' );
		SimpleRouter::get( '/registreer/bedankt', 'RegistreerController@registreerbedankt' )->name( 'registreer.bedankt' );
		SimpleRouter::get( '/registreer/bevestigen/{code}', 'RegistreerController@registeerValidatie' )->name( 'registreer.validatie' );

		//login routes
		SimpleRouter::get( '/', 'LoginController@loginForm' )->name( 'login.form' );
		SimpleRouter::post( '/login/verwerken',	'LoginController@verwerkLoginForm' )->name( 'login.verwerken' );
		SimpleRouter::get( '/loguit', 'LoginController@loguit' )->name( 'loguit' );

		SimpleRouter::get( '/login/succes', 'LoginController@loginSucces' )->name( 'login.succes' );

		//SimpleRouter::get( '/stuur-test-email', 'EmailController@sendTestEmail' )->name( 'email.test' );
		//SimpleRouter::get( '/bekijk-test-email', 'EmailController@viewTestEmail' )->name( 'view.email' );

		SimpleRouter::get( '/contact', 'ContactController@contactForm' )->name( 'contact.form' );
		SimpleRouter::post( '/contact/versturen', 'ContactController@verwerkContactForm' )->name( 'contact.verwerk' );

		SimpleRouter::match(['get','post'], '/wachtwoord-vergeten', 'LoginController@wachtwoordVergeten' )->name( 'wachtwoord.vergeten' );
		SimpleRouter::match(['get','post'], '/wachtwoord-reset/{reset_code}', 'LoginController@wachtwoordResetForm' )->name( 'wachtwoord.reset' );






	//Stap 1:   routes.php: maak SimpleRouter in dit bestand,
	//Stap 2:
	//parameter #1 = url    waneer je basisUrl+/'dit' invult dan zal dat ook worden getoond in urlbalk
	// 			#2 = callback trigger wanneer de route overeenkomt
	//		  #3 = naam van de public/private functie in    private/controllers/   naam van #2.php
					#4 = render
	//				   			#1	             #2                     #3									#4
	SimpleRouter::get('/registreren', 'RegistrationController@registrationForm')->name('register.form');

	//winkel pagina
	SimpleRouter::get('/winkelpagina', 'WinkelpaginaController@winkelpagina')->name('winkelpagina');

	//winkel Bestelpagina
	SimpleRouter::get('/bestelpagina', 'BestelController@bestelpagina')->name('bestelpagina');


	//Maps pagina
	SimpleRouter::get('/maps', 'MapsController@maps')->name('maps');

	//Uplaod
  SimpleRouter::get('/upload', 'UploadController@upload')->name('upload');

	//saveImg
  SimpleRouter::post('/opslaan', 'UploadOpslaanController@opslaan')->name('opslaan');

	//route die registreer knop zal afhandelen,    de form method = POST
	SimpleRouter::post('/registreren/verwerken', 'RegistrationController@handleRegistrationForm')->name('register.handle');


	//zoeken
	SimpleRouter::post('/search', 'SearchController@search')->name('search');












	// STOP: Tot hier al je eigen URL's zetten
	SimpleRouter::get( '/not-found', function () {
		http_response_code( 404 );

		return '404 Page not Found';
	} );

} );


// Dit zorgt er voor dat bij een niet bestaande route, de 404 pagina wordt getoond
SimpleRouter::error( function ( Request $request, \Exception $exception ) {
	if ( $exception instanceof NotFoundHttpException && $exception->getCode() === 404 ) {
		response()->redirect( site_url() . '/not-found' );
	}

} );
