<?php

function glup($arrc)
{    
    krsort($arrc);
    
    $inver = array();

    foreach ($arrc as $key => $value) {
        array_push($inver,$value);
    }    

    return $inver;
}


//$palabra = array('h','o','l','a');
//var_dump(glup($palabra));

?>