<?php global $libreto ?>
<?php
if(isset($_POST['new_name'])):
  if($new_name = $_POST['new_name']) :
    if($_POST['custom_instance']):
      echo $instance = trim($_POST['instance']) . '.';
    else:
      echo $instance = '';
    endif;
    if( $root = $libreto->options('root') && $libreto->options('root') != '/' ) :
      $root = '/' . trim($root, '/ ') . '/' ;
    else :
      $root = '/';
    endif;
    $sheme =        ( isset($_SERVER["HTTPS"]) ? 'https' : 'http' ) . '://';
    $server_name =  trim($_SERVER["SERVER_NAME"], '/ ');
    header('Location:' . $sheme . $instance . $server_name . $root . urlencode($new_name) );
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

  <link rel="stylesheet" href="<?= $libreto->base_url() ?>/libreto/assets/style-index.css">

  <script src="<?= $libreto->base_url() ?>/libreto/assets/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="<?= $libreto->base_url() ?>/libreto/assets/script-home.js"></script>
</head>

<body>

  <form action="" method="POST">

    <div class="introduction">
      <?= l('introduction') ?>
    </div>

    <div class="colophon small">
      <?= l('colophon') ?>
    </div>

    <div class="url">
      <span class="subdomain">
        <select name="instance">
          <?php
          foreach($libreto->options('providers') as $id => $provider):
            ?>
            <option value="<?= $id ?>" title="<?= $provider['name'] ?>"><?= $id ?>&nbsp;&nbsp;&nbsp;</option>
            <?php
          endforeach;
          ?>
        </select>
      </span><span class="dot">.</span><span class="domain"><?= str_replace('//','',strstr($libreto->base_url(), '//')) ?>/</span><span class="directory"><input type="input" autofocus="autofocus" onfocus="this.select()" name="new_name" placeholder="<?= l('name', false) ?>" /></span>
      <button type="submit" /><?= l("create", false) ?></button>
    </div>

    <div class="instance small">
      <input type="checkbox" id="custom_instance" name="custom_instance"> <?= l('instance', false) ?>
    </div>

  </form>

</body>

</html>
