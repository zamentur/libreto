<?php
session_start();

function snippet($name){
  require ROOT . DS . 'views' . DS . 'snippets' . DS . $name . '.php';
}

function l($keyword, $markdown = true){
  global $libreto;
  $keyword = trim($keyword);
  $template = $libreto->router()->template();
  $language = $libreto->language();
  $filename = $template . "." . $language . ".yml";
  $dictionnary = Spyc::YAMLLoad(ROOT . DS . 'views' . DS . 'languages' . DS . $filename);
  if(array_key_exists($keyword, $dictionnary)):
    $text = $dictionnary[$keyword];
    return ($markdown ? parsedown($text) : $text);
  else:
    return $keyword;
  endif;
}

function parsedown($markdown){
  global $Parsedown;
  $html = $Parsedown
     ->setBreaksEnabled(true) # enables automatic line breaks
     ->text($markdown);
  return $html;
}

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 ||
    (substr($haystack, -$length) === $needle);
}

function url_get_contents($Url) {
  if (!function_exists('curl_init')){
      die('CURL is not installed!');
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $Url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}

function br2nl($text){
  $breaks = array("<br />","<br>","<br/>");  
  return str_ireplace($breaks, "\r\n", $text);
}
