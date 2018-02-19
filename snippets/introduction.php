<header class="<?= $_SESSION['header'] ?>">
  <div class="full">
    <?= $homepage ?>
    <div class="colophon">
      <?= $Parsedown->text(file_get_contents("./texts/colophon.md")); ?>
    </div>
    <button class="switch">×</button>
  </div>
  <div class="reduced">
    <p class="site_name">Libreto</p>
    <p class="libreto_name"><?= $libreto_name ?></p>
    <button class="switch">?</button>
  </div>
</header>
