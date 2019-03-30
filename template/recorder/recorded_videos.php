<?php
include("header.php");
include("inc.php");
if ($_GET['ios']) echo "<div class=info>iOS does not support Flash browser plugin: Only playback with HTML5 is possible.</div>";
if (($rec=$_GET['delete'])&&$delete_from)
{
	echo "Deleting $rec ...";
	if (file_exists($file = $delete_from . $rec  . ".flv")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . ".mp4")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . "-ip.mp4")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . ".log")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . "-ogv.log")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . "-mp4.log")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . ".key")) unlink($file);
	if (file_exists($file = $delete_from . $rec  . ".meta")) unlink($file);
	if (file_exists($file = "recordings/" . $rec  . ".vwr")) unlink($file);
	if (file_exists($file = "snapshots/" . $rec  . ".jpg")) unlink($file);
}
?>
<div class="info">
<b>Video Recordings</b> / <a href="index.php">Record New Video</a><br />

<?php
date_default_timezone_set('UTC');
$recs = array();

$dir="recordings";
$handle=opendir($dir);
while (($file = readdir($handle))!==false)
if ((substr($file,-3)=="vwr") && (!is_dir("$dir/".$file)))
{
	$recs[$file] = filemtime("$dir/".$file);
}

arsort($recs);

foreach ($recs as $fil => $ftm)
{
  $vid=substr($fil,0,-4);
  $params=explode(";;;",implode(file("$dir/".$fil)));
  if (count($params))
  {
  $ts=$params[2];
  $tm=floor($ts/60);
  $ts=$params[2]-$tm*60;
  $info=$params[0]." Duration: $tm:$ts  Date: " . date ("F d Y H:i:s", $ftm);
  }

  echo "<a href='streamplay.php?vid=$vid'>
  <IMG WIDTH='240' TITLE='$info' ALT='$info'
   BORDER=5 SRC='".(file_exists("snapshots/$vid.jpg")?"snapshots/$vid.jpg":"snapshots/no_video.png")."'></a>";
}
?>
</div>