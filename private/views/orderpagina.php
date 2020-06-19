
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf8">
    <meta name="author" content="Leroy Andrade">
    <meta name="content" content="Fro JSON/XHTML">
    <meta name="description" content="Periode 4 leerjaar 2">
    <meta name="keywords" content="Front-End, front-end. Front-end, front end, Front end, Frontend">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styleL.css">
    <title>Overzicht winkelmand</title>
</head>

    <body lang="nl">
    <header style="margin-top: 50px">
    <nav>
    <input type="button" value="&#8801;" id="menuClosed1">

        <img src="afb/heart.svg" id="menuClosed2" alt="" style="margin: 0 auto">

        <img src="" id="menuClosed4" alt="">

          <a href="<?php echo site_url( '/bestelpagina' );?>">
        <div class="winkelwagen"> <span class="winkelwagen__aantal"></span></div></a>

    </nav>


            <section id="menuOpen" >
                <label for="toggleLabel" id="toggleLabel" class="pl-40">Sharing is caring</label>
            <!--  <input type="button" value="&#8801" id="menuButtonOpen"> = -->
              <!-- <input type="button" value="&Chi;" id="menuButtonOpen">X -->
              <ul>
                          <li class="pb-100">< <a href="http://29118.hosts2.ma-cloud.nl/bewijzenmap/ProjectP4/Code/public/">Login</a></li>

                          <li><a href="<?php echo site_url( "/winkelpagina" );?>">Boodschappen</a></li>

                          <li><a href="#">Ons concept</a></li>

                          <li><a href="#">Wordt bezorger</a></li>

                          <li><a href="#">Contact</a></li>

                          <li><a href="<?php echo site_url( '/maps/' );?>" target="_blank" ><u>Locatie</u></a></li>
                      </ul>
            </section>

    </header>




        </a><br/>
        <p><a href="<?php echo site_url( "/winkelpagina" );?>">Verder winkelen</a></p>


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
