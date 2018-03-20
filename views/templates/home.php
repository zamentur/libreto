<?php global $libreto ?>
<?php
if(isset($_POST['new_name'])):
  if($new_name = $_POST['new_name']) :
    header('Location:' . $libreto->options('url') . '/' . urlencode($new_name) );
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

  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="/libreto/assets/script-home.js"></script>
</head>

<body>
  <div class="introduction">
    <?= l('introduction') ?>
  </div>

  <div class="instance small">
    <?= l('instance') ?>
  </div>

  <div class="colophon small">
    <?= l('colophon') ?>
  </div>

  <div class="url">
    <form action="" method="POST">
      <span class="subdomain">
        <span class="select">
          <select id="instance">
            <option value="framapad">framapad</option>
            <option value="board" selected>board</option>
            <option value="etherpad">etherpad</option>
          </select>
        </span>
      </span><span class="dot">.</span><span class="domain">libreto.net/</span><span class="directory"><input type="input" autofocus="autofocus" onfocus="this.select()" name="new_name" placeholder="<?= l('name', false) ?>" /></span>
      <button type="submit" /><?= l("create", false) ?></button>
    </form>
  </div>
</body>

</html>
