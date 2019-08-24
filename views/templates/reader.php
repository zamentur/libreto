<?php
global $libreto;
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $libreto->name() ?> - Libreto</title>
  <link rel="stylesheet" href="<?= $libreto->base_url() ?>/libreto/assets/style-reader.css">
  <style>
    <?= $libreto->pads()->css() ?>
  </style>
</head>
<body>
  <main class="content">
    <?php
    if ($libreto->router()->pad()) :
      echo $libreto->pads()->selected()->html();
    else:
      echo '<h1>' . $this->name() . '</h1>';
      $pads = $this->pads()->children('visible');
      foreach($pads as $pad) :
        echo '<h2>' . $pad->name() . '</h2>';
        echo '<div>' . $pad->html() . '</div>';
      endforeach;
    endif;
    ?>
  </main>
</body>
</html>
