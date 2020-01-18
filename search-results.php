<?php
    require_once('header.php');
?>

<?php
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    $filme_filtrate=array();
    $durataMax=cel_mai_lung_film($movies);
    $z=strlen($_GET['s']);
    if($z < 3){?>
      <h1>Expresiile căutate trebuie să aibă măcar 3 caractere.</h1>
<?php }
    else{
    function in_title($val){
        global $z;
        if( stripos($val->title, substr($_GET['s'], 0, $z) ) === false )return 0;
        else return 1;
    }

    while($z >= 3 && count($filme_filtrate)==0){
        $filme_filtrate=array_filter($movies,'in_title'); 
        $z--;
    }
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