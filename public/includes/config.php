<?php
// Kopieer dit bestand naar config.php met je eigen gegevens
// config.php wordt niet naar Github gestuurd, wel zo veilig.
// Zet dus NOOIT in dit bestand je geheime gegevens, deze dient alleen als voorbeeld

$config = [
	/*
	'DB'       => [
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'database' => 'l1-p4-project'

	*/
	'DB'       => [
	'hostname' => '127.0.0.1',
	'username' => 'c5405LeroyA',
	'password' => 'vhnnpijr',
	'database' => 'c5405temp'
	],
//	'BASE_URL' => '/AMC/PROJ/MVC/public',  // Zet hier het pad naar de public map in, vanaf http://localhost, anders werken je routes niet!
	'BASE_URL' => '/bewijzenmap/periode4.4/proj/mvc/public',  // Zet hier het pad naar de public map in, vanaf http://localhost, anders werken je routes niet!
	'ROOT'     => dirname( dirname( __DIR__ ) ),
	'PRIVATE'  => dirname( __DIR__ ),
	'WEBROOT'  => dirname( dirname( __DIR__ ) ) . '/public'
];

return $config;
