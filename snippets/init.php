<?php
// OPEN / CLOSE HEADER
if ( ! isset($_SESSION['header']) ) :
  $_SESSION['header'] = 'close';
endif;

// READ / WRITE MODE
if ( ! isset($_SESSION['mode']) ) {
  $_SESSION['mode'] = 'read';
}
if(isset($_GET['mode'])):
  if($_GET['mode'] == "write") :
    $_SESSION['mode'] = 'write';
  else :
    $_SESSION['mode'] = 'read';
  endif;
  // redirect to same page without url parameters
  $url = strtok($_SERVER["REQUEST_URI"],'?');
  header('Location: ' . $url );
endif;


$custom_css = false;
$libreto_name = get_libreto_name();
$pads_list = get_pads_list();
$current_pad_name = get_current_pad_name();
$currentiframe = $current_pad_name ? get_url ( $current_pad_name ) : false ;
$homepage = get_homepage();
