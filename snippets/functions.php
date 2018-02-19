<?php
session_start();

require_once './config.php';
require_once './assets/parsedown/Parsedown.php';
require_once './assets/parsedown-extra/ParsedownExtra.php';
require_once './assets/html2opendocument/Base.php';
require_once './assets/html2opendocument/Text.php';
require_once './assets/htmlpurifier/library/HTMLPurifier.auto.php';

$Purifier = new HTMLPurifier();
$Parsedown = new ParsedownExtra();
$Parsedown = $Parsedown->setBreaksEnabled(true);

function get_homepage() {
  $homepage = get_html(get_url("introduction", "markdown"));
  $exerpt = trim(strip_tags($homepage));
  if(strpos($exerpt, "–––––") === 0):
    $homepage = get_html(get_url("help", "markdown"));
  endif;
  return $homepage;
}

function get_pads_list() {
  global $libreto_name, $custom_css;
  $pads_list = file(get_url("menu", "txt"));
  $pads_list = array_map('trim', $pads_list);
  // if pad is filled with default text, make pads_list empty
  $firstline = $pads_list[0];
  if( strpos($firstline, "–––––") === 0 ) :
    $pads_list = false;
  endif;
  // if a pad is named style.css, use it as css file
  if($pads_list):
    foreach ($pads_list as $key=>$pad_name) :
      if($pad_name == "style.css"):
        array_splice($pads_list, $key, 1);
        $custom_css = get_url($pad_name, "txt");
      endif;
    endforeach;
  endif;
  return $pads_list;
}

function get_url($name, $format = "pad") {
  global $pads_host, $site_prefix, $pads_params, $libreto_name;

  $server = "http://" . $_SERVER["SERVER_NAME"];
  $pads_prefix = "libreto+" . urlencode($libreto_name) . "+";
  $pad_name =  $pads_prefix . urlencode($name);
  $css_name = $pads_prefix . urlencode("style.css");
  $pad_url = $pads_host . "/p/" . $pad_name;

  if($name == 'help') :
    $pad_url = "https://annuel2.framapad.org/p/libreto-help";
    if ($format == "markdown") {
      return  $pad_url . "/export/markdown";
    } else {
      return  $server . "/reader.php?host=$pads_host&pad=libreto-help&css=$css_name";
    }
  endif;

  switch ($format) :
    case 'pad':
      if($_SESSION['mode'] == "write") :
        return $pad_url . $pads_params ;
      else:
        //var_dump($pad_url);
        return $server . "/reader.php?host=$pads_host&pad=$pad_name&css=$css_name" ;
      endif;
      break;

    default:
      return $pad_url . "/export/" . $format ;
      break;
  endswitch;
}

function get_html($markdown_url) {
  global $Parsedown, $Purifier;
  $markdown = file_get_contents($markdown_url);
  // remove \url{} tags
  $markdown = preg_replace('#\\\url\{(.+)\}#i', '$1', $markdown);
  // replace underline tags
  $markdown = preg_replace('#underline(.+)underline#', '<u>$1</u>', $markdown);
  // remove slashes
  $markdown = stripslashes($markdown);
  $html = $Parsedown->text($markdown);
  // sanitize html
  $html = $Purifier->purify($html);
  return $html;
}

function export() {
  global $libreto_name, $homepage, $pads_list;
  $title = $libreto_name;
  $introduction = $homepage;

  $chapters = $pads_list;
  $chapters = array_map(function($chapter){
    $url = get_url($chapter, 'markdown');
    $html = get_html($url);
    return array("title" => $chapter, "content" => $html);
  }, $chapters);

  $odt = new \CatoTH\HTML2OpenDocument\Text();
  $odt->addHtmlTextBlock('<h1>' . $title . '</h1>');
  $odt->addHtmlTextBlock($homepage);
  foreach ($chapters as $chapter) {
    $odt->addHtmlTextBlock('<h2>' . $chapter['title'] . '</h2>');
    $odt->addHtmlTextBlock($chapter['content']);
  }
  $odt->finishAndOutputOdt('Libreto-' . $title . '.odt');
}

function get_current_pad_name() {
  global $use_subdomain, $pads_list;
  if(is_array($pads_list)):
    $default_pad = $pads_list[0];
  else:
    $default_pad = false;
  endif;
  $uri = explode( '/', trim($_SERVER['REQUEST_URI'], '/') );
  if($use_subdomain) :
    if (array_key_exists(0, $uri)):
      $uri = urldecode($uri[0]);
      $pad_name = in_array($uri, $pads_list) ? $uri : false;
    else :
      $pad_name = $default_pad;
    endif;
  else :
    if (array_key_exists(1, $uri)):
      $uri = urldecode($uri[1]);
      if(is_array($pads_list)) :
        $pad_name = in_array($uri, $pads_list) ? $uri : false;
      else :
        $pad_name = false;
      endif;
    else :
      $pad_name = $default_pad;
    endif;
  endif;
  return $pad_name;
}

function get_libreto_name() {
  global $use_subdomain;
  if($use_subdomain) :
    $server_name = explode(".",$_SERVER["SERVER_NAME"]);
    if (array_key_exists(0, $server_name) && array_key_exists(1, $server_name)):
      $name = urldecode($server_name[0]);
      $name = strtok( $name ,'?');
    endif;
  else:
    $uri = explode( '/', trim($_SERVER['REQUEST_URI'], '/') );
    if (array_key_exists(0, $uri)):
      $name = urldecode($uri[0]);
      $name = strtok( $name ,'?');
    endif;
  endif;
  return $name;
}

function curl_get_contents($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
