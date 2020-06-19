<?php
// Dit bestand hoort bij de router, enb bevat nog een aantal extra functiesdie je kunt gebruiken
// Lees meer: https://github.com/skipperbent/simple-php-router#helper-functions
require_once __DIR__ . '/route_helpers.php';

// Hieronder kun je al je eigen functies toevoegen die je nodig hebt

//registratie gegevens uit formulier


// Maar... alle functies die gegevens ophalen uit de database horen in het Model PHP bestand

/**
 * Verbinding maken met de database
 * @return \PDO

 * Geeft de juiste URL terug: relatief aan de website root url
 * Bijvoorbeeld voor de homepage: echo url('/');
 *
 * @param $path
 *
 * @return string
 */
function site_url( $path = '' ) {
	return get_config( 'BASE_URL' ) . $path;
}

function get_config( $name ) {
	$config = require __DIR__ . '/config.php';
	$name   = strtoupper( $name );

	if ( isset( $config[ $name ] ) ) {
		return $config[ $name ];
	}

	throw new \InvalidArgumentException( 'Er bestaat geen instelling met de key: ' . $name );
}

/**
 * Hier maken we de template engine en vertellen de template engine waar de templates/views staan
 * @return \League\Plates\Engine
 */
function get_template_engine() {

	$templates_path = get_config( 'PRIVATE' ) . '/views';

	return new League\Plates\Engine( $templates_path );

}

/**
 * Geef de naam (name) van de route aan deze functie, en de functie geeft
 * terug of dat de route is waar je nu bent
 *
 * @param $name
 *
 * @return bool
 */
function current_route_is( $name ) {
	$route = request()->getLoadedRoute();

	if ( $route ) {
		return $route->hasName( $name );
	}
	return false;
}








function dbConnect() {

	// Lees het config bestand in en sla de array uit config op in een variabele
	$config = get_config( 'DB' );

	try {
		// Verbinding maken met gebruik van de database instellingen die in de variabelen zijn opgeslagen
		$connection = new 		PDO( 'mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'], $config['username'], $config['password'] );
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		return $connection;

	} catch ( PDOException $e ) {
		echo "Fout bij verbinding met de database: " . $e->getMessage();
		exit();
	}

	return false;

}

/**
 * Geeft het totaal aantal rijen terug
 *
 * @param $connection
 *
 * @return int
 */

function getTotalCountries( $connection ) {
	//TODO: Hier de juiste query zetten om het totaal aantal countries te tellen
	$sql       = 'SELECT COUNT(*) AS `Totaal` FROM `country`';
	$statement = $connection->query( $sql );

	return (int) $statement->fetchColumn();
}

/**
 * Haalt alle landen op voor het opgegeven paginanummer
 *
 * @param \PDO $connection The database connection
 * @param int $page Pagenumber
 * @param int $pagesize Number of results per page
 *
 * @return array
 */
function getCountries( $connection, $page = null, $pagesize) {

	// De parameter $page naar een getal omzetten met (int)
	$page  = (int)$page; //echo gettype($page);

	// Beginnen met de SQL query om ALLES op te halen

	//tijdelijk als comment om niet te veel hoeven scrollen tijdens ontwikkeling:
	//$sql = 'SELECT * FROM `country`';

	$sql = 'SELECT * FROM `country`';
//	$sql = 'SELECT * FROM `country` LIMIT 10 OFFSET 158 ';

	// Alle gegevens ophalen van de database.
		$total =getTotalCountries( $connection );

	//TODO: Het totaal aantal landen ophalen (check de functie in dit bestand!)
		$num_pages = (int) round($total / $pagesize);

	//TODO: welke berekening moet hier komen? Gebruik de variabelen );


	// Als pagina nummer te groot is dan naar laatste pagina zetten
	//TODO: Hoe bereken je waar je moet beginnen (welke variabelen kun je hiervoor gebruiken?)
		//je begint bij pagina 1 en begint bij rij 0 = pagina =0 * aantal paginas
		$offset = ($page -1) * $pagesize;

	// Nu plakken we de juiste LIMIT en OFFSET achter de SQl die we al hadden
	//handig! nu kan ik een bestaande variabele aanvulllen met .=
	$sql .= ' LIMIT ' . $pagesize . ' OFFSET ' . $offset;
 //	//$sql  = ' LIMIT . $pagesize .  OFFSET . $offset';
 //	//$limitnOffset  = 'SELECT * FROM `country` LIMIT . $pagesize .  OFFSET . $offset';

	$statement = $connection->query($sql);

	// Deze array met informatie geeft de functie terug
	//$pagesize = $_GET['page'];




	//$pages weergeeft aantal pagina numering blokken waar pagina nummers in te recht komen te staan
	$pages=$num_pages;
	return [
		'statement' => $statement,
		'total'     => $total,
		'pages'     => $pages,
		'page'      => $page
	];
}//session_destroy();








function validateRegistrationData( $data 	) {

	$errors = [];

	$email 			= filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL );
	$wachtwoord = trim( $_POST['wachtwoord'] );

	if ( $email	=== false ) {
		$errors['email'] = 'Geen geldig email adres';
	}

	if ( strlen( $wachtwoord) < 6 ) {
		$errors['wachtwoord'] = 'Geen geldig wachtwoord (Minimaal 6 tekens)';
	}

	$data = [
		'email' => $data['email'],
		'wachtwoord' => $wachtwoord
	];

	return [
		'database' => $data,
		'errors' => $errors
	];
}


function loginGebruiker( $gebruiker ) {
	$_SESSION['gebruiker_id'] = $gebruiker['id'];
}

function loguitGebruiker() {
	unset($_SESSION['gebruiker_id'] );
}
function isIngelogd() {
	return !empty( $_SESSION['gebruiker_id'] );
}

function loginCheck() {
	if ( ! isIngelogd() ) {
		$login_url = url( 'login.form' );
		redirect( $login_url );
	}
}

/**
 * Maak de SwiftMailer aan en stet hem op de juiste manier in
 *
 * @return Swift_Mailer
 */
function getSwiftMailer() {
	$mail_config = get_config( 'MAIL' );
	$transport   = new \Swift_SmtpTransport( $mail_config['SMTP_HOST'], $mail_config['SMTP_PORT'] );
	$transport->setUsername($mail_config['SMTP_USER'] );
	$transport->setPassword($mail_config['SMTP_PASSWORD']);

	$mailer = new \Swift_Mailer( $transport );

	return $mailer;
}

/**
 * Maak een Swift_Message met de opgegeven subject, afzender en ontvanger
 *
 * @param $to
 * @param $subject
 * @param $from_name
 * @param $from_email
 *
 * @return Swift_Message
 */
function createEmailMessage( $to, $subject, $from_name, $from_email ) {

	// Create a message
	$message = new \Swift_Message( $subject );
	$message->setFrom( [ $from_email => $from_email ] );
	$message->setTo( $to );

	// Send the message
	return $message;
}

/**
 *
 * @param $message \Swift_Message De Swift Message waarin de afbeelding ge-embed moet worden
 * @param $filename string Bestandsnaam van de afbeelding (wordt automatisch uit juiste folder gehaald)
 *
 * @return mixed
 */
function embedImage( $message, $filename ) {
	$image_path = get_config( 'WEBROOT' ) . '/images/email/' . $filename;
	if ( ! file_exists( $image_path ) ) {
		throw new \RuntimeException( 'Afbeelding bestaat niet: ' . $image_path );
	}

	if($message) {

	$cid = $message->embed( \Swift_Image::fromPath( $image_path ) );

	return $cid;

	}

	return site_url('/images/email/' . $filename );

}

/**
 *
 * Bevestigd een acount met code
 *
*/

function bevestigAccount( $code ) {

	$connection = dbConnect();
	$sql				= "UPDATE `gebruikers` SET `code` = NULL WHERE `code` = :code";
	$statement  = $connection->prepare( $sql );
  $params = [
		'code' => $code
	];
	$statement->execute($params);
}

function stuurVerificatieEmail($email, $code) {

	$url = url( 'registreer.validatie', ['code' => $code] );
	$absolute_url = absolute_url( $url );

	$mailer = getSwiftMailer();

	$message = createEmailMessage($email, 'Bevestig je acount', 'Sharing is Caring', '30168@ma-web.nl' );

	// $email_text = 'Bevestig jouw account om in te kunnen loggen: ' . $absolute_url;

	$template_engine = get_template_engine();
	$html = $template_engine->render('bevestiging_email', ['message' => $message, 'url' => $absolute_url]);

	$message->setBody( $html, 'text/html');

	$mailer->send($message);

}

function stuurWachtwoordResetEmail( $email ) {

	// Code genereren en opslaan bij dit email adres (gebruiker)
	$reset_code = md5( uniqid( rand(), true ) );
	$connection = dbConnect();
	$sql        = "UPDATE `gebruikers` SET `password_reset` = :code WHERE `email` = :email";
	$statement  = $connection->prepare( $sql );
	$params     = [
		'code'  => $reset_code,
		'email' => $email
	];

	$statement->execute( $params );

	$url          = url( 'wachtwoord.reset', [ 'reset_code' => $reset_code ] );
	$absolute_url = absolute_url( $url );

	$mailer  = getSwiftMailer();
	$message = createEmailMessage( $email, 'Wachtwoord resetten', 'Sharing is Caring', '30168@ma-web.nl' );

	// $email_text = 'klik <a href="' . $absolute_url . '">hier</a> om je wachtwoord te resetten';

	$template_engine = get_template_engine();
	$html = $template_engine->render('wachtwoord_vergeten_email', ['message' => $message, 'url' => $absolute_url]);

	$message->setBody( $html, 'text/html');

	$mailer->send( $message );

}
