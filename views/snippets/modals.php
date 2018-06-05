<?php global $libreto ?>
<div class="modal-cover <?= count($libreto->pads()->children()) > 1 ? 'hide' : '' ?>"></div>
<div class="modal modal-about <?= count($libreto->pads()->children()) > 1 ? 'hide' : '' ?>">
  <div class="title"><?= l("modal-help-title") ?></div>
  <button class="btn-close">×</button>
  <div class="content">
    <?= l("modal-help") ?>
    <hr>
    <div class="colophon">
      <div><?= l('about') ?> <a href="<?= $libreto->provider('url') ?>" target="_blank"><?= $libreto->provider('name') ?></a></div>
      <div><?= l('credits') ?></div>
    </div>
  </div>
</div>
