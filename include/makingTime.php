<?php
function MakingTime($mtime){
  $time = preg_split("/:/", $mtime);
  if(intval($time[0]) != 0){
    $hour = intval($time[0]) . " óra";
  } else {
    $hour = "";
  }
  if(intval($time[1]) != 0){
    $minute = intval($time[1]) . " perc";
  } else {
    $minute = "";
  }

  return $hour . " " . $minute;
}
