
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf8">
    <meta name="author" content="Leroy Andrade">
    <meta name="content" content="Project">
    <meta name="description" content="Periode 4 leerjaar 2">
    <meta name="keywords" content="Front-End, front-end. Front-end, front end, Front end, Frontend">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url( '/css/styleL.css' ) ?>" media="all">
    <title>Overzicht</title>
    <style>
/* Always set the map height explicitly to define the size of the div
* element that contains the map. */
html, body {

height: 100%;
margin: 0;
padding: 0;
}
#kaart {  height: 90%;}
image{  width: 20px;  height: 20px;}

@media only screen and (max-width: 600px) {
body {
  background-color: blue;
}
}

    </style>
</head>
    <body lang="nl">


    <header>
    <nav>
    <input type="button" value="&#8801;" id="menuClosed1">

        <img src="afb/heart.svg" id="menuClosed2" alt="">

        <label for="">
            <form action="./zoeken.php" method="GET">
                <input type="text" name="zoekbalkText">
                <img src="afb/zoek.svg" id="menuClosed3"  alt="">
                <input type="submit" value="Zoeken">
            </form>
        </label>

        <img src="" id="menuClosed4" alt="">

        <a href="bestelOverzicht.php">
        <div class="winkelwagen"> <span class="winkelwagen__aantal"></span></div></a>

    </nav>


            <section id="menuOpen">
                <label for="toggleLabel" id="toggleLabel" class="pl-40">Sharing is caring</label>
            <!--  <input type="button" value="&#8801" id="menuButtonOpen"> = -->
              <!-- <input type="button" value="&Chi;" id="menuButtonOpen">X -->
			  <ul>
                    <li class="pb-100"><a href="<?php echo site_url();?>
                    ">Home</a></li>

                    <li><a href="<?php echo site_url( "/winkelpagina" );?>">Boodschappen</a></li>
                             
                    <li><a href="#">Ons concept</a></li>

                    <li><a href="#">Wordt bezorger</a></li>

                    <li><a href="#">Contact</a></li>

                    <li><a href="<?php echo site_url( '/maps/' );?>" target="_blank"><u>Locatie</u></a></li>
                </ul>
            </section>
        
    </header>

	
    <div id="kaart"></div>

<script>
      

  number_=(a)=>
  {
    return parseFloat(a);
  }

    function Kaart(zoom, latV, lngV, imgWidth, imgHeight){
      let optie       = this;
      optie.zoom      = number_(zoom);
      optie.latV      = number_(latV);//latitude Value
      optie.lngV      = number_(lngV);//longitude Value
      optie.imgWidth  = number_(imgWidth);
      optie.imgHeight = number_(imgHeight);

      /*
      optie.latV   = parseFloat(52.3909788);//latitude Value
      optie.lngV   = parseFloat(4.8560811);//longitude Value
      */
    }                                    //zoom, latV,       lngV,      imgWidth, imgHeight
    const detailsMediacollege  = new Kaart("18", 52.3910013, 4.8560877, 90,       60);
     initMap= () =>{
     opties={ 
             zoom:    detailsMediacollege.zoom, //=18 ->regel 35 & 46
             center: {lat:detailsMediacollege.latV, lng:detailsMediacollege.lngV}
             }

    //kaart aanmaken
    const kaart = new google.maps.Map(document.getElementById('kaart'), opties);

    //markeer punt
    let image ={ 
        url: '../afb/maps/Map-marker-groen.jpg',
      //verander grootte van marker-groen afbeelding
      scaledSize: new google.maps.Size(detailsMediacollege.imgWidth, detailsMediacollege.imgHeight)
    }  
    const positieMarkeer = {lat: detailsMediacollege.latV, lng: detailsMediacollege.lngV}
    const markeer = new google.maps.Marker({position: positieMarkeer, title: "Amsterdam Mediacollege, de toekomst is vandaag.",icon: image, map: kaart});
  }
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKDHtQV9q6P_ENUguqLKxnKW5LlANOAnQ&callback=initMap" async defer></script>
  
  <!--W3 validatoren-->
    <p>
      <a href="http://jigsaw.w3.org/css-validator/check/referer">
          <img style="border:0;width:88px;height:31px"
              src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
              alt="Valide CSS!"/>
          </a>
      </p>



    <script src="<?php echo site_url( '/js/menu.js' );?>" charset="utf-8"></script>
    </body>
</html>


