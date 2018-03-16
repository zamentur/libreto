<?php
$providers = array(
  'framapad'  => array(
    'name'                       => "Framapad",
    'url'                        => "https://annuel2.framapad.org",
    'default_text'               => "–––––",
  ),
  'board'  => array(
    'name'                       => "Board",
    'url'                        => "https://board.net",
    'default_text'               => "--",
  )
);

$options = array(
  'name'                            => "Libreto",
  'default_provider'                => "framapad",
  'providers'                       => $providers,
);
