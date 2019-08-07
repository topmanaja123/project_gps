<?php 

function DateYMD($strDate)
{
  list($d,$m,$y)=explode("/",$strDate);
  $dateTH=$y."-".$m."-".$d;
  return "$dateTH";
}

?>