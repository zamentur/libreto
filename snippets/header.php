<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $libreto_name ?> - Libreto</title>
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/belgica-belgika" type="text/css"/>
  <link rel="stylesheet" href="/assets/style.css">
  <script type="text/javascript">
    var use_subdomain = <?= $use_subdomain ?>;
  </script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="/assets/script.js"></script>
  <?= $custom_css ? '<style>' . $custom_css . '</style>' : '' ?>
</head>
<body>
