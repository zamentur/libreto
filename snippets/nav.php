<nav>
  <ul class="helpers">
    <li class='switcher_button <?= $_SESSION['mode'] == 'read' ? 'active' : ''; ?>'><a href="?mode=read">Read</a></li>
    <li class='switcher_button <?= $_SESSION['mode'] == 'write' ? 'active' : ''; ?>'><a href="?mode=write">Write</a></li>
  </ul>
  <ul class="menu">
    <?php if($_SESSION['mode']=="write"): ?>
      <li class='pad_button settings'><a href='<?= get_url("menu") ?>' target='myframe' data-name-encoded=''>Menu</a></li>
      <li class='pad_button settings'><a href='<?= get_url("introduction") ?>' target='myframe' data-name-encoded=''>About</a></li>
      <?php if($custom_css): ?>
        <li class='pad_button settings'><a href='<?= get_url("style.css") ?>' target='myframe' data-name-encoded=''>style.css</a></li>
      <?php endif; ?>
    <?php endif; ?>
    <?php
    if ($pads_list) :
      foreach ($pads_list as $pad_name) {
        $active = $current_pad_name == $pad_name ? "active" : "";
        ?>
        <li class='pad_button <?= $active ?>'>
          <a href='<?= get_url($pad_name) ?>' target='myframe' data-name='<?= $pad_name ?>' data-name-encoded='<?= urlencode($pad_name) ?>'><?= $pad_name ?></a>
        </li>
        <?php
      }
    endif;
    ?>
  </ul>
  <?php if($_SESSION['mode']=="write"): ?>
  <ul class="helpers">
    <li class='pad_button'><a href='<?= get_url("help") ?>' target='myframe' data-name-encoded=''>Help</a></li>
  </ul>
  <ul class="helpers">
    <li class=""><a href='?export' class="" data-name-encoded=''>Export</a></li>
    <li class='pad_button'><a href='' class="refresh" data-name-encoded=''>Refresh</a></li>
  </ul>
  <?php endif; ?>
</nav>
