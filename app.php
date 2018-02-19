<?php include('snippets/functions.php') ?>
<?php include('snippets/init.php') ?>
<?php include('snippets/controller.php') ?>
<?php include('snippets/header.php') ?>
<div id="container">
  <?php include('snippets/introduction.php') ?>
  <?php include('snippets/nav.php') ?>
  <article>
    <iframe id="framepad" name="myframe" width=600 height=400 src="<?= $currentiframe ?>"></iframe>
  </article>
</div>
<?php include('snippets/footer.php') ?>
