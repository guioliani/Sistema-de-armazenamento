<?php

function formatBytes($size, $precision = 2){
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

function formatBytesNoSufixe($size, $precision = 2){
	$base = log($size, 1024);

	return round(pow(1024, $base - floor($base)), $precision);
}


function CriaPasta($nomePasta){
  $dir = $nomePasta;
  if(is_dir($dir)){
    return "Pasta ja existe";
  }else{
    mkdir($dir,0777, true);
  }
}

?>