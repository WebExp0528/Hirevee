<?php

$rtmp_server="rtmp://198.154.106.194/record";
// rtmp://your-server-ip-or-domain/application

$rtmp_amf="AMF3";
// AMF3 : Red5, Wowza, FMIS3, FMIS3.5
// AMF0 : FCS1.5, FMS2
// blank for flash default

$jwplayer=0;
// 1 : enable jwplayer installed in jwplayer folder

$delete_from="webcamrecording/";
//enable delete recording from specified folder (ending in /); can be relative to this file

$video_from = "webcamrecording/";
//path where recording files are stored on server - required for convesion

$play_from = "webcamrecording/";
//relative url where streams can be accessed by http - required for web players like html5
//$time_limit  = $_POST['time_limit'];
$time_limit = 180;
?>