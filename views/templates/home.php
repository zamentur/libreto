<?php global $libreto ?>
<?php
if(isset($_POST['new_name'])):
  if($new_name = $_POST['new_name']) :
    header('Location: ' . $libreto->options('url') . '/' . urlencode($new_name) );
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

  <link rel="stylesheet" href="/libreto/assets/style-index.css">
</head>

<body>
  <article>
    <?= l('introduction') ?>
    <div class="create_libreto">
      <form action="" method="POST">
        <input type="input" autofocus="autofocus" onfocus="this.select()" name="new_name" />
        <button type="submit" /><?= l("create", false) ?></button>
      </form>
    </div>
  </article>
  <div class="colophon" markdown="1">
    <?= l('colophon') ?>
  </div>
</body>

</html>
