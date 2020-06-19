<?php
session_start();
?><!DOCTYPE html>
<html lang="nl">
<head>
    <title>Project Promo</title>
    <meta charset="UTF-8">
    <meta name="author" content="Leroy Andrade">
    <meta name="content" content="bap Les 5">
    <meta name="description" content="Periode 3 leerjaar 1">
    <meta name="keywords" content="bap, Les 5, geweldig, prachtig">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo site_url( '/css/styleL.css' ) ?>" media="all">
</head>

  <body>
    <header>
    <nav>
    <input type="button" value="&#8801;" id="menuClosed1">

        <img src="afb/heart.svg" id="menuClosed2" alt="">

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


            <section id="menuOpen" style="margin-top:-25vw">
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









    <form action="<?php echo site_url( "/opslaan" );?>" method="POST" enctype="multipart/form-data">
    <table style="margin-bottom: 100px; justify-content: center; margin:25% 35vw;">



        <tr>
            <td> <input type="tel" id="titel" name="titel" placeholder="Vul Titel in"></td>
        </tr>

        <tr>
            <td colspan="2"><label for="artiest"> &nbsp</label></td>
        </tr>



        <tr>
            <td> <input type="tel" id="artiest" name="artiest" placeholder="Vul prijs in"></td>
        </tr>

        <tr>
            <td colspan="2"><label for="album">&nbsp; </label></td>
        </tr>



        <tr>
            <td colspan="2"><label for="afbeelding">&nbsp;</label></td>
        </tr>

          <tr>
        <div class="inputFile">
              <td> <input type="file" id="afbeelding" name="afbeelding" accept="image/x-png,image/jpeg,image/svg" placeholder="Plaats afbeelding">
              </td>
            </div>
          </tr>

        <tr>
        <td><input type="submit" name="submit" id="submit" value="Upload"></td>
        </tr>
    </table>
  </form>

    <script src="<?php echo site_url( '/js/menu.js' ) ?>" charset="utf-8"></script>
  </body>
</html>
