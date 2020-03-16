<?php

    function db_connect($host = 'localhost' , $username = 'Paul' , $password = '0121kiralypaul' , $db_name = 'filme'){
        return mysqli_connect($host , $username , $password , $db_name);
    }

    function creeaza_tabel_rating(){
        global $link;
        $query = "CREATE TABLE IF NOT EXISTS `rating`( id INT PRIMARY KEY AUTO_INCREMENT  , nota INT(5)  , denumire_film VARCHAR(50) )";
        return mysqli_query($link , $query);
    }

    function adauga_nota($titlu , $nota){
        global $link;
        $query = "INSERT INTO rating(denumire_film , nota) VALUES('$titlu' , '$nota')";
        mysqli_query($link , $query);
    }

    function cel_mai_lung_film($movies){
        if( isset($_COOKIE['longest-movie-lenght']) ){
            return $_COOKIE['longest-movie-lenght'];
        }
        else{
        $maxT=max( array_column($movies , 'runtime') );
        setcookie('longest-movie-lenght' , $maxT);
        return $maxT;
        }
    }

    function sec_in_ore_si_min($timp){
        $ore=floor($timp->runtime / 60);
        $minute=$timp->runtime % 60;
        echo $ore , ' h';
        echo " si ", $minute , " min";
    }

    function nr_note($title){
        global $link;
        $result = mysqli_query($link , "SELECT * FROM rating WHERE denumire_film = '$title' ");
        return mysqli_num_rows($result);
    }

    function media_notelor($nume_film){
        global $link;
?>
    
    <h2 style="padding: 0px 10px; width: fit-content;">
<?php
        echo 'Media notelor: ';
        $average = mysqli_query($link , "SELECT AVG(`nota`) AS PriceAverage FROM `rating` WHERE `denumire_film` = '$nume_film' ");
        $result = mysqli_fetch_array($average);
        echo round ($result['PriceAverage'] , 2);
?>
    <div class="stea"></div>
    </h2>
    
<?php      
    }
?>