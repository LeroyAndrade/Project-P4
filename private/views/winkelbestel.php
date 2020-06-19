
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf8">
    <meta name="author" content="Leroy Andrade">
    <meta name="content" content="Project">
    <meta name="description" content="Periode 4 leerjaar 2">
    <meta name="keywords" content="Front-End, front-end. Front-end, front end, Front end, Frontend">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url( '/css/styleL.css' ) ?>" media="all">
    <title>Overzicht</title>

</head>
    <body lang="nl">

    <header>
    <nav>
    <input type="button" value="&#8801;" id="menuClosed1">

        <img src="afb/heart.svg" id="menuClosed2" alt="">

        <label for="">
            <form action="<?php echo url( "search" );?>" method="POST">
                <input type="text" name="zoekbalkText">
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
          <ul>
                      <li class="pb-100">< <a href="http://29118.hosts2.ma-cloud.nl/bewijzenmap/ProjectP4/Code/public/">Login</a></li>

                      <li><a href="<?php echo site_url( "/winkelpagina" );?>">Boodschappen</a></li>


                      <li><a href="<?php echo site_url( "/upload" );?>">Upload</a></li>

                      <li><a href="<?php echo site_url( '/maps/' );?>" target="_blank"><u>Locatie</u></a></li>
                  </ul>

            </section>

    </header>



    <a href="bestelOverzicht.php">

        </a><br/>
        <p><a href="index.php" >Verder winkelen</a></p>


        <div id="bestelling"></div>
        <div id="bestellingTotaal"></div>
        <input type="button" value="Bestel" onclick="Bestel()">


        <div id="bestellingPlaatsen"></div>


            <script>
            function Bestel(){
                let xyz = localStorage.getItem('besteldeItem');

                if (localStorage.getItem('besteldeItem') == null ){
                    document.getElementById("bestellingPlaatsen").innerHTML = "U 8528572852 geen items in het bestelmandje";
                }
                else if (localStorage.getItem('besteldeItem') !== null){
                     document.getElementById("bestellingPlaatsen").innerHTML = "U heeft data  adres ingevoerd";

                 }
                }
            </script>
            <div></div>
        </div>
        <script src="<?php echo site_url( '/js/bestelOVerzicht.js' ) ?>" charset="utf-8"></script>
        <script src="<?php echo site_url( '/js/menu.js' ) ?>" charset="utf-8"></script>


        </section>

        <p class="productenSectie">
      <a href="http://jigsaw.w3.org/css-validator/check/referer">
          <img style="border:0;width:88px;height:31px"
              src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
              alt="Valide CSS!"/>
          </a>
      </p>
    </body>
</html>
