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
