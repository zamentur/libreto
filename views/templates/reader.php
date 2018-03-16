<?php
global $libreto;
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $libreto->name() ?> - Libreto</title>
  <link rel="stylesheet" href="/libreto/assets/style-reader.css">
  <style>
    <?= $libreto->pads()->css() ?>
  </style>
</head>
<body>
  <main class="content">
    <?php
    if ($libreto->router()->pad()) :
      ?>
      <?= $libreto->pads()->selected()->html() ?>
      <?php
    else:
      ?>
      <h1><?= $this->name() ?></h1>
      <?php
      $pads = $this->pads()->children('visible');
      foreach($pads as $pad) :
        ?>
        <h2><?= $pad->name() ?></h2>
        <div><?= $pad->html() ?></div>
        <?php
      endforeach;
    endif;
    ?>
  </main>
</body>
</html>
