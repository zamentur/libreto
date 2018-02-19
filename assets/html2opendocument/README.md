This is a simple PHP-library to create create OpenDocument Text- and Spreadsheet-files (ODT / ODS) from HTML-formatted text.

It does not support formulae / calculations in spreadsheets. The focus lies on formatted text.


## Example Scripts

A demo script for the OpenDocument Text converter using the default template:

```php
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

$html = '<p>This is a demo for the converter.</p>
<p>The converter supports the following styles:</p>
<ul>
    <li>Lists (UL / OL)</li>
    <li><strong>STRONG</strong></li>
    <li><u>U</u> (underlined)</li>
    <li><s>S</s> (strike-through)</li>
    <li><em>EM</em> (emphasis / italic)</li>
    <li><ins>INS</ins> (Inserted text)</li>
    <li><del>DEL</del> (Deleted text)</li>
    <li>Line<br>breaks with BR</li>
</ul>
<blockquote>You can also use BLOCKQUOTE, though it lacks specific styling for now</blockquote>';

$html2 = '<p>You might be interested<br>in the fact that this converter<br>
also supports<br>line numbering<br>for selected paragraphs</p>
<p>Dummy Line<br>Dummy Line<br>Dummy Line<br>
Dummy Line<br>Dummy Line</p>';

$odt = new \CatoTH\HTML2OpenDocument\Text();
$odt->addHtmlTextBlock('<h1>Test Page</h1>');
$odt->addHtmlTextBlock($html, false);
$odt->addHtmlTextBlock('<h2>Line Numbering</h2>');
$odt->addHtmlTextBlock($html2, true);
$odt->finishAndOutputOdt('demo.odt');
```


A demo script for the OpenDocument Spreadsheet converter using the default template:

```php
use CatoTH\HTML2OpenDocument\Spreadsheet;
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

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
```



## License

This library is licensed under the [MIT license](http://opensource.org/licenses/MIT)