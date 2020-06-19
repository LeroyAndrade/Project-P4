<?php
/**
 * Verbinding maken met de database
 *
 * @return bool|PDO
 */
// require 'includes/index.php';

function dbConnect() {

	// Lees het config bestand in en sla de array uit config op in een variabele
	$config = require( __DIR__ . '/config.php' );

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
    $sql       = 'SELECT COUNT(*) AS `Totaal` FROM `boeken` ';
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

	$sql = 'SELECT * FROM `boeken`';
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

        $zoekbalkText = $_GET["zoekbalkText"];
        $params=[
            'zoekbalkText' => '%'. $zoekbalkText . '%'
        ];
	// Nu plakken we de juiste LIMIT en OFFSET achter de SQl die we al hadden
	//handig! nu kan ik een bestaande variabele aanvulllen met .=
	$sql .= ' LIMIT ' . $pagesize . ' OFFSET ' . $offset;
 //	//$sql  = ' LIMIT . $pagesize .  OFFSET . $offset';
 //	//$limitnOffset  = 'SELECT * FROM `country` LIMIT . $pagesize .  OFFSET . $offset';

	$statement = $connection->query($sql);

	// Deze array met informatie geeft de functie terug
	//$pagesize = $_GET['page'];

$zoekbalkText = $_GET["zoekbalkText"];


	//$pages weergeeft aantal pagina numering blokken waar pagina nummers in te recht komen te staan
	$pages=$num_pages;
	return [
		'statement' => $statement,
		'total'     => $total,
		'pages'     => $pages,
		'page'      => $page
	];
}//session_destroy();
