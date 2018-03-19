<?php global $libreto ?>
<nav>
  <ul class="helpers">
    <li class='switcher_button <?= $_SESSION['mode'] == 'read' ? 'active' : ''; ?>'><a href="?mode=read"><?= l("read", false) ?></a></li>
    <li class='switcher_button <?= $_SESSION['mode'] == 'write' ? 'active' : ''; ?>'><a href="?mode=write"><?= l("write", false) ?></a></li>
    <li class='' style="flex: 0;"><a href='' class="refresh" data-name-encoded='' alt='<?= l("update", false) ?>'>↻</a></li>
  </ul>
  <ul class="menu">

    <?php foreach ($libreto->pads()->children() as $pad): ?>

      <li class='pad_button <?= $pad->selected() ? "active" : false ?> <?= $pad->type() ?>'>
        <a href='<?= $pad->url() ?>' target='myframe' style='color: <?= $pad->color() ?>' data-name='<?= $pad->name(); ?>' data-name-encoded='<?= urlencode(strtolower($pad->name())) ?>'><?= $pad->name() ?></a>
      </li>

    <?php endforeach; ?>

  </ul>
  <?php if($_SESSION['mode']=="write"): ?>
  <ul class="helpers">
    <li class=""><a href='/bindery/<?= $libreto->name() ?>' class="" data-name-encoded=''><?= l("export", false) ?></a></li>
    <li class=""><a href='/export/<?= $libreto->name() ?>' class="" data-name-encoded='' download><?= l("download", false) ?></a></li>
  </ul>
  <?php endif; ?>
</nav>
