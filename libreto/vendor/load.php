<?php

require_once 'parsedown/Parsedown.php';
require_once 'parsedown-extra/ParsedownExtra.php';
require_once 'html2opendocument/Base.php';
require_once 'html2opendocument/Text.php';
require_once 'htmlpurifier/library/HTMLPurifier.auto.php';
require_once 'spyc/Spyc.php';

$Purifier = new HTMLPurifier();
$Parsedown = new ParsedownExtra();
$Parsedown = $Parsedown->setBreaksEnabled(true);
