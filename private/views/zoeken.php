<?php
//require 'includes/connectie.php';
require 'includes/functionsZoeken.php';



$zoekbalkText = $_POST["zoekbalkText"];


$connection = dbConnect();
$sql = 'SELECT `titel`, `cover` FROM `boeken` WHERE `titel` = :zoekbalkText';

$statement = $connection->prepare( $sql );

$params=[
    'zoekbalkText' => '%'. $zoekbalkText . '%'
];
$statement->execute($params);


$page = 1;


if ( isset( $_GET['page'] ) ) {
	// Tenzij in de url een page paramater staat, dan die waarde gebruiken
	$page = (int) $_GET['page'];
}

//TODO: Hoeveel resultaten per pagina wil je?
$pagesize = 2;
$result = getCountries( $connection, $page, $pagesize );

//$ab = json_encode($result, true);
//$bc = json_decode($_POST["titel"]);

//echo var_dump(json_encode($result, true));

?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="./css/styleL.css">
    </head>
    <body>
        <?php
foreach($statement as $rows)
{?>

<section class="grid-2">
               <h1> <?php echo $rows['titel'].'<br/>' ;?></h1>
                    <img src="./<?php echo $rows['cover']?>" alt="" class="boekSelectie__cover" width='100'>
                </main>
</section>


    <?php
}
?>



	<section class="countries">
		<?php foreach ( $result['statement'] as $country ): ?>
			<div class="country">
						<h2><?php echo $country['cover'] 	?>
							<span class="country-code">			<?php echo $country['titel'] 			?></span> </h2>
			</div>
		<?php endforeach ?>
	</section>

<div class="pagination grid-2">
	<p></p>
        <a href="zoeken.php?zoekbalkText=<?php echo $_POST["zoekbalkText"]; ?>" name="page" class="pagination__number"><?php echo 1; ?></a>

</div>

    </body>
</html>
