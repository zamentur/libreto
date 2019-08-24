<?php
global $libreto;
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?= $libreto->name() ?> - Libreto</title>
</head>
<body>

  <script src="/libreto/assets/js/bindery.umd.js"></script>
  <script src="/libreto/assets/js/bindery-controls.min.js"></script>
  <script src="/libreto/assets/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="/libreto/assets/style-reader.css">
  <style><?= $libreto->pads()->book_css(); ?></style>
  <script>
  var defaultBook = {
    content: {
      selector: '.content',
      url: '/reader/<?= $libreto->name() ?>/',
    },
    view: Bindery.View.PRINT,
    ControlsComponent: BinderyControls,
    printSetup: {
      paper: Bindery.Paper.AUTO_MARKS,
      layout: Bindery.Layout.SPREADS,
      marks: Bindery.Marks.BOTH,
    },
    pageSetup: {
      size: { width: '14.5cm', height: '20cm' },
      margin: {
        top: '2cm',
        bottom: '2cm',
        inner: '2cm',
        outer: '2cm',
      },
    },
    rules: [
      Bindery.PageBreak({
        selector: 'h2',
        position: 'before',
        continue: 'next',
      }),
      Bindery.PageBreak({
        selector: 'h1',
        position: 'before',
        continue: 'right',
      }),
      Bindery.RunningHeader({
        render: (page) => {
          if (page.isEmpty) return '';
          if (page.isLeft) {
            let section = Object.values(page.heading)[0];
            return `${page.number} · ${section} `;
          } else if (page.isRight) {
            let section = Object.values(page.heading).splice(1).join(' – ');
            if (section !== '') return `${section} · ${page.number}`;
            else return `${page.number}`;
          }
        },
      }),
      Bindery.Footnote({
        selector: 'a',
        render: (element, number) => {
          return '<i>' + number + '</i>: ' + element.href;
        }
      }),
      Bindery.FullBleedPage({ selector: '.fullpage', continue: 'next' }),
    ]
  };
  var customBook = <?= $libreto->pads()->book_js() ?: 'false' ?>;
  var options = $.extend( true, defaultBook, customBook );
  Bindery.makeBook(options);
  </script>
</body>
</html>
