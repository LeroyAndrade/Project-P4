<?php
session_start();
        // Sla alle fouten die er zijn op in een array
        $errors =[];
        //check of er een afbeelding is geupload
        if ( ! isset($_FILES['afbeelding'])){
            echo 'Geen bestand Geupload!';
            exit;
        } else{
            // check bestand op errors
            $file_error = $_FILES['afbeelding']['error'];
            switch($file_error){
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errors[] ='Er is geen bestand geupload';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errors[] ='Kan niet schrijven naar disk';
                    break;
                    case UPLOAD_ERR_INI_SIZE:
                        $errors[] = 'Error: het bestand is groter dan het maximaal toegestane grootte';
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $errors[] = 'Error: dit bestand is te groot, pas php.ini aan';
                        break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errors[] = 'Error: er kan geen tijdelijk folder worden aangemaakt';
                    break;
                default:
                    $errors[] = '';
                }
              }
        // ga verder mits er geen fouten zij
        if(count($errors)===0){
            // Bestandsnaam in key: name
            $file_name = $_FILES['afbeelding']['name'];

            // Grootte in bytes in key: size
            $file_size = $_FILES['afbeelding']['size'];

            // Tijdelijke opslag in key: tmp_name
            $file_tmp = $_FILES['afbeelding']['tmp_name'];

            // Bestandstype in key: type
            $file_type = $_FILES['afbeelding']['type'];


            // Bestands types die geaccepteerd moeten worden
            $valid_image_types = [
                1 => 'gif',
                2 => 'jpg',
                3 => 'png'
            ];
            $image_type        = exif_imagetype($file_tmp);
            if ($image_type !== false) {
                // Juiste bestandsextensie zoeken
                $file_extension = $valid_image_types[$image_type];
            }else{
                $errors[] = 'Dit is geen afbeelding!';
            }
        }

        // doorgaan om bestand een unieke naam te geven mits er geen fouten zijn, anders
        if (count($errors) === 0) {
            // Willekeurige bestandsnaam genereren
            $new_filename = sha1_file($file_tmp) . '.' . $file_extension;
            $final_filename = 'uploads/' . $new_filename;

            // met move_uploaded_file verplaats je het tijdelijke bestand naar de uiteindelijke plek
            move_uploaded_file( $file_tmp, $final_filename ); // dus van tijdelijke bestandsnaam naar de originele naam (in de huidige map);

            // Op deze plek sla je de bestandsnaam en andere gegevens op in je database, dat mag je zelf doen.

          //hier maak ik pas verbinding met de database, wanneer er geen error is
            try {
                $conn = mysqli_connect("127.0.0.1","c5405LeroyA", "vhnnpijr", "c5405temp");

                // echo "Verbinding is gemaakt!";

                // Kopieer de gegevens uit $_POST naar eigen variabelen
                $query='INSERT INTO `boeken` (`titel`, `prijs`,`cover`)
                    VALUES(:titel, :prijs, :cover)';

                $titel = $_POST["titel"];
                $prijs = $_POST["prijs"];
                $cover = $_POST["cover"];
                $afbeelding = $new_filename;
                // Bereid de SQL voor en bind de variabelen aan de juiste :placeholder parameters

              $parameters =[
              'titel' => $titel,
              'prijs' => $prijs,
              'cover' => $cover,
              'afbeelding' => $afbeelding
              ];
              $sql = $conn->prepare($query);



//sanitized output doorzetten naar server
                $sql->execute($parameters);
            }

            catch(PDOException $e) {
                echo 'Fout bij database verbinding: ' . $e->getMessage() . ' op regel ' . $e->getLine() . ' in ' . $e->getFile();
        }
}
            // Stuur de gebruiker door naar een andere pagina



        		echo $template_engine->render('winkelpagina');


    ?>
