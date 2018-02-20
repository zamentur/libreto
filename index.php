<?php
include('snippets/functions.php');
$user_language = get_user_language();
$translation = load_translation_file();

if(isset($_POST['new_name'])):
  if($new_name = $_POST['new_name']) :
    header('Location: ' . 'http://' . $_SERVER["SERVER_NAME"] . '/' . urlencode($new_name) );
  endif;
endif;
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Libreto</title>

  <link rel="stylesheet" href="/assets/style-index.css">
</head>

<body class="current-lang-<?= get_user_language() ?>">
  <article>
    <?php
    $markdown = file_get_contents("assets/texts/homepage.md");
    $Parsedown = new ParsedownExtra();
    $html = $Parsedown->setBreaksEnabled(true)->text($markdown);
    echo $html;
    ?>
    <div class="create_libreto">
      <form action="" method="POST">
        <input type="input" autofocus="autofocus" onfocus="this.select()" name="new_name" />
        <button type="submit" /><?= localize("create-libreto") ?></button>
      </form>
    </div>
  </article>
</body>

</html>
