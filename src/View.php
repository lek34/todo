<?php

namespace Uph22si1Web\Todo;

use Uph22si1Web\Todo\Exceptions\TemplateNotFoundException;

class View {
  public static function render(string $template, array $data): void {
    $templateFile = __DIR__ . "/../views/$template.view.php";

    if (!file_exists($templateFile)) {
      throw new TemplateNotFoundException("Template not found: $template");
    }

    // https://www.php.net/manual/en/function.ob-start.php
    ob_start();

    // anonymous function supaya tidak ada data yang tidak diinginkan bocor
    // ke template yang akan di render
    (function() use($templateFile, $data) {
      // https://www.php.net/manual/en/function.htmlspecialchars.php untuk men-sanitasi
      // data yang akan di-render ke HTML
      // https://www.php.net/manual/en/function.array-map.php digunakan untuk meng-apply
      // function ke setiap item di dalam array, fungsi ini menerima callable/anonymous function
      // dan array yang akan dioperasikan
      $escaped_data = array_map(fn($i) => htmlspecialchars($i), $data);

      // https://www.php.net/manual/en/function.extract.php
      extract($escaped_data);

      // https://www.php.net/manual/en/function.include.php
      // WARNING: karena kita langsung menginclude dan mengevaluasi file template
      // seluruh isi file template akan di-execute sebagai script php
      // termasuk code yang merusak sistem
      // proper implementation untuk templating adalah dengan membuat mini language
      // dengan kemampuan yang dibatasi
      include $templateFile;
    })();

    echo ob_get_clean();
  }
}
