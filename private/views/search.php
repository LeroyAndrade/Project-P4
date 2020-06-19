
<?php

$page = 1;
    if ( isset( $_GET['page'] ) ) {
    	// Tenzij in de url een page paramater staat, dan die waarde gebruiken
    	$page = (int) $_GET['page'];
    }


?>

<html>
    <head>
    <link rel="stylesheet" href="<?php echo site_url( '/css/styleL.css' ) ?>" media="all">
    </head>

    <body>


      <header>
      <nav>
      <input type="button" value="&#8801;" id="menuClosed1">

          <img src="<?echo url('afb/heart.svg' );?>" id="menuClosed2" alt="">

          <label for="">
              <form action="<?php echo url( "search" );?>" method="POST">
                  <input type="text" name="zoekbalkText" >
                  <img src="afb/zoek.svg" id="menuClosed3"  alt="">
                  <input type="submit" value="Zoeken">
              </form>
          </label>

          <img src="" id="menuClosed4" alt="">

          <a href="<?php echo site_url( '/bestelpagina' );?>">
          <div class="winkelwagen"> <span class="winkelwagen__aantal"></span></div></a>

      </nav>


              <section id="menuOpen">
                  <label for="toggleLabel" id="toggleLabel" class="pl-40">Sharing is caring</label>
              <!--  <input type="button" value="&#8801" id="menuButtonOpen"> = -->
                <!-- <input type="button" value="&Chi;" id="menuButtonOpen">X -->
                 <ul>
                      <li class="pb-100">< <a href="http://29118.hosts2.ma-cloud.nl/bewijzenmap/ProjectP4/Code/public/">Login</a></li>

                      <li><a href="<?php echo site_url( "/winkelpagina" );?>">Boodschappen</a></li>

                      <li><a href="#">Ons concept</a></li>

                      <li><a href="#">Wordt bezorger</a></li>

                      <li><a href="<?php echo site_url( "/upload" );?>">Upload</a></li>

                      <li><a href="<?php echo site_url( '/maps/' );?>" target="_blank"><u>Locatie</u></a></li>
                  </ul>

              </section>

      </header>




        <?php
foreach( $result as $rows ) :?>
  <section class="grid-2" style="margin-top: 100px;">
                 <h1> <?php echo $rows['titel'].'<br/>' ;?></h1>
                    <img src="<?php echo site_url( '/'.str_replace("./","",$rows['cover'])); ?>" alt="" class="boekSelectie__cover" width='100'>
  </section>
<?php endforeach; ?>




<?php echo count($result);?>


<div class="pagination grid-2">
	<p></p>
        <a href="zoeken.php?zoekbalkText=<?php echo $_POST["zoekbalkText"]; ?>" name="page" class="pagination__number" ><?php echo 1; ?></a>

</div>

<script src="<?php echo site_url( '/js/menu.js' ) ?>" charset="utf-8"></script>
    </body>
</html>
