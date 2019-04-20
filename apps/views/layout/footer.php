<?php
if (isset($footer_content)) {
	echo $footer_content;
}
///////////////////////////////Translate///////////////////////////////////////
//echo '<div id="google_translate_element"></div>';
///////////////////////////////Translate///////////////////////////////////////

if (isset($error_msg) && !empty($error_msg))
{
	echo '<script type="text/javascript">alert("'.$error_msg.'");</script>';
}

echo '</body>';
echo '</html>';
?>