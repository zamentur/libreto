<?php
include('snippets/functions.php');

$pad_url = "https://annuel2.framapad.org/p/libreto-help";
$host = array_key_exists('host', $_GET) ? $_GET['host'] : false;
$css_name = array_key_exists('css', $_GET) ? urlencode($_GET['css']) : false;
$pad_name = array_key_exists('pad', $_GET) ? urlencode($_GET['pad']) : false;
$html = $css = false;
if($host && $pad_name):
  $pad_url = $host . "/p/" . $pad_name . "/export/markdown";
  $html = get_html($pad_url);
endif;
if($css_name) :
  $css_url = $host . "/p/" . $css_name . "/export/txt";
  $css = file_get_contents($css_url);
endif;
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Pad reader</title>
	<link rel="stylesheet" href="/assets/style-reader.css">
  <?= $css_name ? "<style>" . $css . "</style>" : "" ?>
</head>

<body>
	<?= $html ?>
</body>

</html>
