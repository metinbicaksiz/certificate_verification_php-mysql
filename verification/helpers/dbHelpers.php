
<?php
    function dbConnect(){
        try{
			// DB Config (Localhost)
            /*$username = 'metinbicaksiz';
            $password = '2029005658Metin';
            $conn = new pdo("mysql:host=localhost;dbname=cert_database;", $username, $password);*/
			
		
            $username = 'u8143902_deneme';
            $password = '2029005658Metin';
            $conn = new pdo("mysql:host=localhost;dbname=u8143902_cert_database;", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        }   catch(PDOException $e){
            echo 'ERROR', $e->getMessage();
        }
    }
?>

