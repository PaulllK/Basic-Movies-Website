<?php
    require_once('header.php');
?>

<?php
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    $filme_filtrate=array();
    $durataMax=cel_mai_lung_film($movies);
    if( strlen($_GET['s']) < 3){?>
      <h1>Expresiile căutate trebuie să aibă cel puțin 3 caractere.</h1>
<?php }
    else{
    function in_title($val){
        if( stripos($val->title, $_GET['s']) === false )return 0;
        else return 1;
    }
    $filme_filtrate=array_filter($movies,'in_title'); 
?>
<?php
    if(count($filme_filtrate) > 0){
?>
     <h1>Resultate pt <?php echo "'{$_GET['s']}'"; ?></h1>
     <ul>
<?php
        foreach($filme_filtrate as $film_cur){
            require('archive-movie.php');
        } 
?>
     </ul>
<?php }else{
?>   
        <h1>Niciun rezultat pt <?php echo "'{$_GET['s']}'"; ?>. Încearcă altceva.</h1>    
<?php }
    }
?>
</ul>
<?php
    require_once('footer.php');
?>