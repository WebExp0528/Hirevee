<?php
include("header.php");
include("inc.php");

$vid = $_GET['vid'];
$player = $_GET['player'];
if ($_GET['debug']) $debug = $_GET['debug'];

$agent = $_SERVER['HTTP_USER_AGENT'];
if( strstr($agent,'iPhone') || strstr($agent,'iPod') || strstr($agent,'iPad')) if (!$player) 
{
$player='ip';
echo "<div class=info>iOS Device detected: Showing HTML5 version</div>";
}
if ($jwplayer && !$player) $player = "jw";
if (!$player) $player = "vw";
?>

<div align="center" style="width:480px;height:360px" class="info">
<?
switch ($player)
{
case "jw":
$path_only = implode("/", (explode('/', $_SERVER["SCRIPT_URI"], -1)));	
?>
<script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js">
</script>
<p id="container1">Please install the Flash Plugin</p>
<script type="text/javascript">
var flashvars = { file: "<?php echo urlencode($vid); ?>", streamer: "<?php echo $rtmp_server; ?>", autostart: "true", type: "rtmp", image: "<?php echo  dirname($_SERVER['PHP_SELF']) . "/" . (file_exists("snapshots/$vid.jpg")?"snapshots/$vid.jpg":"snapshots/no_video.png"); ?>" };
  
  swfobject.embedSWF('jwplayer/player.swf','container1','480','360','9','false', flashvars,   {allowfullscreen:'true',allowscriptaccess:'always'},   {id:'jwplayer',name:'jwplayer'}  );
</script>
<p><a href="streamplay.php?player=vw&vid=<?php echo urlencode($vid); ?>">Play using VideoWhisper Stream Player</a></p>		

<?php

break;

case "vw":

$swfurl="streamplayer.swf?streamName=".urlencode($vid)."&serverRTMP=".urlencode($rtmp_server)."&templateURL=";

?>
<object width="100%" height="100%">
<param name="movie" value="<?=$swfurl?>"></param><param name="scale" value="noscale" /><param name="salign" value="lt"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed width="100%" height="100%" scale="noscale" salign="lt" src="<?=$swfurl?>" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true"></embed>
</object>
<?php

break;

case "ip":

if (file_exists($output_file= $video_from . $vid  . "-ip.mp4"))
{
$play_url = $play_from . $vid  . "-ip.mp4";
$play_urlw = $play_from . $vid  . ".ogv";
?>
<video width="480" height="352"  autobuffer autoplay controls="controls">
 <source src="<?php echo $play_url?>" type='video/mp4'>
 <source src="<?php echo $play_urlw?>" type='video/ogg'>
    <div class="fallback">
	    <p>You must have an HTML5 capable browser.</p>
	</div>
</video>

<?
} 
else
if (file_exists($file = $video_from . $vid  . ".flv"))
{

$log_file = $video_from . $vid  . "-mp4.log";

//full path is very important!
$cmd ="/usr/local/bin/ffmpeg -y -i $file -b 512k -vcodec libx264 -flags +loop+mv4 -cmp 256 -partitions +parti4x4+parti8x8+partp4x4+partp8x8 -subq 6 -trellis 0 -refs 5 -bf 0 -flags2 +mixed_refs -coder 0 -me_range 16 -g 250 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -qmin 10 -qmax 51 -qdiff 4 -acodec libfaac -ar 44100 -ab 96k -vpre baseline  $output_file >&$log_file &";
if ($debug) echo "$cmd<BR>";
if (!$debug) exec($cmd, $output, $returnvalue); else echo exec($cmd, $output, $returnvalue);

if ($debug) var_dump($output);
//if ($debug) echo shell_exec('ls');
  
if ($returnvalue == 127) {
    # not available
    echo "<BR>Sorry! FFMPEG is not available for conversion!";
    }
else {
    #available
    echo "<BR>Requested version not found but conversion started. <BR><a href='streamplay.php?player=ip&vid=$vid'>Please reload shortly!</a>";
    
    //ogv
	$output_filew= $video_from . $vid  . ".ogv";
	$log_filew = $video_from . $vid  . "-ogv.log";
	$cmd = "/usr/local/bin/ffmpeg2theora $file -o $output_filew -V 512 -A 96 &>$log_filew &";
	exec($cmd, $output, $returnvalue);

}
  //  var_dump($output);

}
else echo "Recording $vid.flv not found!";

break;
}

	if ($delete_from && $player=='vw' && !strstr($_SERVER['HTTP_USER_AGENT'],'bot') ) 
	{
	?>
<p><a onclick="javascript:return confirm('Are you sure you want to delete this video recording?')" href="recorded_videos.php?delete=<?php echo urlencode($vid); ?>">Delete this Recording (<?php echo $vid; ?>)</a></p>		
	<?php
	}
	
	if ($video_from && $play_from && $player!='ip') 
	{
	?>
    <p><a href="streamplay.php?player=ip&vid=<?php echo urlencode($vid); ?>">Play HTML5 version (iPhone)</a></p>		
	<?php
	}
	
	
 ?>
 <p><a href="recorded_videos.php"><B>Back to Recordings List</B></a></p>
</div>