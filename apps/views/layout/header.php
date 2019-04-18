<?php
echo doctype('html5');
echo '<html lang="en">';
echo '<head>';
// Generates: <meta name="description" content="My Great Site" />
echo meta('Content-Type', 'text/html; charset=' . config_item('charset'), 'http-equiv');
echo meta('viewport', 'width=device-width, initial-scale=1.0', 'name');

//<meta name="google-translate-customization" content="ae6da2d946110233-f07617747366abe5-g62957bb799be833f-b"></meta>
echo meta('google-translate-customization', 'ae6da2d946110233-f07617747366abe5-g62957bb799be833f-b');

if (!isset($title) || empty($title))
{
	echo '<title>' . config_item('site_name') . '</title>';
}
else
{
	echo '<title>' . $title . '</title>';
}
//echo '<link rel="canonical" href="http://www.mui.com" />';

echo link_tag(config_item('image_url') . 'favicon.ico', 'shortcut icon', 'image/x-icon');

echo link_tag(config_item('css_url') . 'bootstrap.css');
echo link_tag(config_item('css_url') . 'bootstrap-responsive.css');

if(BROWSER_TYPE=='M')
	echo link_tag(config_item('css_url') . 'mobile.css');
else 
	echo link_tag(config_item('css_url') . 'common.css');

if (isset($head_css))
{
	if (is_array($head_css))
	{
		foreach ($head_css as $css)
		{
			echo link_tag($css);
		}
	}
	else
	{
		echo link_tag($head_css);
	}
}

echo '<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>';
//echo '<script type="text/javascript" src="' . config_item('js_url') . 'jquery-1.8.3.min.js"></script>';
echo '<script type="text/javascript" src="' . config_item('js_url') . 'jquery-1.8.3.js"></script>';
echo '<script type="text/javascript" src="' . config_item('js_url') . 'bootstrap.js"></script>';
echo '<script type="text/javascript" src="' . config_item('js_url') . 'jquery.validate.js"></script>';
echo '<script type="text/javascript" src="' . config_item('js_url') . 'social_icon.js"></script>';
echo '<script>var image_url = "'.config_item('image_url').'";</script>';


echo '<script type="text/javascript">';
echo 'function googleTranslateElementInit() {';
echo 'new google.translate.TranslateElement({';
echo 'pageLanguage: "en", layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, "google_translate_element");';
echo '}</script>';


echo '</head>';
echo '<body>';

if (isset($header_content))
{
	echo $header_content;
}

?>
