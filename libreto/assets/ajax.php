<?php
session_start();
if( array_key_exists('action', $_POST) ) :
  switch ($_POST['action']):
    case 'headerVisibility':
      if( array_key_exists('visibility', $_POST) ) :
        $_SESSION['header'] = $_POST['visibility'];
      endif;
      break;
    endswitch;
endif;
