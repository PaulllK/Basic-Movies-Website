<?php
    function cel_mai_lung_film($movies)
    {
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
?>