<?php global $libreto ?>
<header class="<?= count($libreto->pads()->children()) > 1 ? 'close' : 'open' ?>">
  <div class="full">
    <?= l("help") ?>
    <hr>
    <div class="colophon">
      <div><?= l('about') ?> <a href="<?= $libreto->provider('url') ?>" target="_blank"><?= $libreto->provider('name') ?></a></div>
      <div><?= l('credits') ?></div>
    </div>
    <button class="switch">×</button>
  </div>
  <div class="reduced">
    <p class="instance_name"><a href="<?= $libreto->options('url') ?>"><?= $libreto->options('name') ?></a></p>
    <p class="libreto_name"><?= $libreto->name() ?></p>
    <button class="switch">?</button>
  </div>
</header>
