<?php
function MakingTime($mtime) {
    $time = preg_split("/:/", $mtime);
    if (intval($time[0]) != 0) {
        $hour = intval($time[0]) . " " . _HOUR;
    } else {
        $hour = "";
    }
    if (intval($time[1]) != 0) {
        $minute = intval($time[1]) . " " . _MIN;
    } else {
        $minute = "";
    }

    return $hour . " " . $minute;
}

function statusText($status){
    if($status == 'rejected'){
      return "<div class='rejected-text'>(" . _REJECTED . ")</div>";
    }
    if($status == 'pending'){
      return "<div class='pending-text'>(" . _PENDING . ")</div>";
    }
    return "";
}
