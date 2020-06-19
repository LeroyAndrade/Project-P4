<?php

namespace Website\Controllers;

/**
 * Class WebsiteController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *
 */
class WinkelpaginaController {

	public function winkelpagina() {

		try{

//$conn = mysqli_connect("127.0.0.1","c5405LeroyA", "vhnnpijr", "c5405temp");
//$conn = mysqli_connect("localhost","root", "", "l1-p4-project");

/*onderstaande manier in plaats van $conn=dbConnect();, omdat er anders een status:500 foutmelding wordt weer*/
//$conn = mysqli_connect("127.0.0.1","c5405LeroyA", "vhnnpijr", "c5405temp");
$sql = 'SELECT `titel`,`cover`, `auteur`, `uitgave`,`ean`, `paginas`,`taal`, `prijs` FROM `boeken` LIMIT 27 OFFSET 2';

$conn=dbConnect();
$statement = $conn->query($sql);
$json_array = array();

foreach($statement as $rows)
{
		$json_array[] = $rows;
}

//maak bestand aan
$text = json_encode($json_array, JSON_NUMERIC_CHECK);
$abc=json_decode($text, true);
$var_str = var_export($text, true);

file_put_contents('boekenSelf.json', $text) . '<br/>';


//echo $text;

$statement = $conn->query($sql);

				} catch(PDOException $e){
						echo 'Fout bij ' . $e->getMessage() . ' op regel '.$e->getLine() . ' in ' . $e->getFile();
				}

		$template_engine = get_template_engine();
		echo $template_engine->render('winkelpagina');
	}

}
