<?php

use CatoTH\HTML2OpenDocument\Spreadsheet;

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php');


$ods = new \CatoTH\HTML2OpenDocument\Spreadsheet();

// Plain text
$ods->setCell(0, 0, Spreadsheet::TYPE_TEXT, 'Plain text with native formatting');
$ods->setCellStyle(0, 0, [], ['fo:font-weight' => 'bold']);

// Print a number as an actual number, just a little bit bigger
$ods->setCell(1, 0, Spreadsheet::TYPE_NUMBER, 23);
$ods->setCellStyle(1, 0, [], [
    'fo:font-size'   => '16pt',
    'fo:font-weight' => 'bold',
]);
$ods->setMinRowHeight(1, 1.5);

// Print a number as text
$ods->setCell(2, 0, Spreadsheet::TYPE_TEXT, '42');

// Draw a border around two of the cells
$ods->drawBorder(1, 0, 2, 0, 1);


// Now we use HTML, and we need a bit more space for that
$html = '<p>The converter supports the following styles:</p>
<ul>
    <li><strong>STRONG</strong></li>
    <li><u>U</u> (underlined)</li>
    <li><s>S</s> (strike-through)</li>
    <li><em>EM</em> (emphasis / italic)</li>
    <li><ins>Inserted text</ins></li>
    <li><del>Deleted text</del></li>
    <li>Line<br>breaks with BR</li>
    <li>Lists (UL / OL) cannot be displayed as lists, but will be flattened to paragraphs</li>
</ul>
<blockquote>You can also use BLOCKQUOTE, though it lacks specific styling for now</blockquote>';

$ods->setMinRowHeight(3, 10);
$ods->setColumnWidth(1, 20);
$ods->setCell(3, 1, Spreadsheet::TYPE_HTML, $html);


$ods->finishAndOutputOds('demo.ods');

?>