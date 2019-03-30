<?php

include("inc.php");
if ($_COOKIE["username"]) $username=$_COOKIE["username"];
$username=substr($username,0,32);

$msg="";
if (!$username) $msg="No recording name provided!";

//suffix to attach to $username and obtain recording filename
//$recordingId="-".base_convert(time(),10,36); //latest versions automatically add time stamp
$recordingId="";

$layoutCode=<<<layoutEND
id=0&label=Video&x=346&y=10&width=326&height=298; id=1&label=Camcorder&x=10&y=10&width=326&height=298
layoutEND;

?>server=<?=$rtmp_server?>&serverAMF=<?=$rtmp_amf?>&username=<?=$username?>&recordingId=<?=$recordingId?>&msg=<?=$msg?>&loggedin=1&camWidth=480&camHeight=360&camFPS=15&camBandwidth=65536&showCamSettings=0&camMaxBandwidth=131072&micRate=22&advancedCamSettings=0&recordLimit=<?=$time_limit?>&bufferLive=900&bufferFull=900&bufferLivePlayback=0.2&bufferFullPlayback=10&layoutCode=<?=urlencode($layoutCode)?>&fillWindow=0&disablePreview=1&loadstatus=1