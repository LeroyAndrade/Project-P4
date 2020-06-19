<?php
function dbConnect()
{
    try {
        $hostname='127.0.0.1';
        $username='c5405LeroyA';
        $password='vhnnpijr';
        $database='c5405temp';

        /*    /*$conn = mysqli_connect("127.0.0.1","c5405LeroyA", "vhnnpijr", "c5405temp");  <<-
        <?php
        $hostname='127.0.0.1';
        $username='c5405LeroyA';
        $password='vhnnpijr';
        $database='c5405temp';



        $hostname='127.0.0.1';
        $username='root';
        $password='';
        $database='l1-p4-project';
        ?>

        */
        $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $e) {
        echo "Volgende foutmelding gegenereerd ".$e->getMessage();
    }
}


?>
