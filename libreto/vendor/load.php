<?php

require_once 'parsedown/Parsedown.php';
require_once 'parsedown-extra/ParsedownExtra.php';
require_once 'html2opendocument/Base.php';
require_once 'html2opendocument/Text.php';
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';
require_once 'spyc/Spyc.php';
require_once 'Markdownify/src/Converter.php';
require_once 'Markdownify/src/ConverterExtra.php';
require_once 'Markdownify/src/Parser.php';

/* --------- Purifier ------------*/

//allow iframes from trusted sources
$config = HTMLPurifier_Config::createDefault();
$config->set('HTML.SafeIframe', true);
$config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%'); //allow YouTube and Vimeo
$Purifier = new HTMLPurifier($config);


$Markdownify = new Markdownify\ConverterExtra;
$Parsedown = new ParsedownExtra();
$Parsedown = $Parsedown->setBreaksEnabled(true);
