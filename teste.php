<?php
    $a=10;
    function s()
    {
        global $a;
        for($i=1 ; $i<6 ;$i++)$a++;
    }
    s();
    echo $a;
?>