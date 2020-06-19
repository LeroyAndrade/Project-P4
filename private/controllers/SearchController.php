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
class SearchController {

	public function search() {


		$conn = dbConnect();
		$zoekbalkText = $_POST['zoekbalkText'];


		$sql = 'SELECT `titel`, `cover` FROM `boeken` WHERE `titel` LIKE :zoekbalkText';

		$statement = $conn->prepare($sql);

		$params=[
		    'zoekbalkText' => '%'. $zoekbalkText . '%'
		];


		//echo var_dump($params['zoekbalkText']);
		$statement->execute($params);


		$template_engine = get_template_engine();
		//geef statement Fetall er aan mee en noem het $result
		echo $template_engine->render('search', ['result'=>$statement->fetchAll()] );
	}

}
