<?php require_once('header.php');?>

<?php     
    $genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;
?>
<div class="row genres">

    <?php
      foreach($genres as $gen)
      {
    ?>      
      <a href="archive.php?genre=<?php echo $gen; ?>" class="genre" style="background-color: #5400<?php echo rand(55,99); ?>">
        <?php echo $gen; ?>
      </a>  
    <?php  } ?>  
    

</div>
<?php require_once('footer.php'); ?>