<?php

namespace App\Adds;

use Config\Services;

class ExportButtons {
  private function getHiddenPostFields(string $exclude = null): string
  {
    $fields = Services::request()->getPost();

    $output = '';

    foreach ($fields as $key => $field) {
      if($key === $exclude) continue;
      $output .= '<input type="hidden" name="' . $key . '" value="' . $field . '" />';
    }

    return $output;
  }

  private function createExportButtons() {
    return <<<HTML
      <div id="export" method="POST" action="" class="buttons">
          <button class="button export" name="json">Export (.json)</button>
          <button class="button export" name="xlsx">Export (.xlsx)</button>
          <button class="button export" name="docx">Export (.docx)</button>
          <script>
            const btns = document.querySelectorAll('.button');
            const form = document.querySelector('#search');
            
            btns.forEach((btn) => {
              btn.addEventListener('click', (ev) => {
                const regexp = /\/(\w+?)?($|\?)/;
                let exportType = '';

                if(btn.name === 'xlsx') exportType = '/excel';
                if(btn.name === 'docx') exportType = '/word';
                if(btn.name === 'json') exportType = '/json';

                if(form.action.includes('?')) {
                  form.action = form.action.replace(regexp, exportType + '?');
                } else {
                  form.action = form.action.replace(regexp, exportType);
                }
                form.submit();
              });
            });
          </script>
      </div>
    HTML;
  }

  public function getExportButtons() {
    return $this->createExportButtons();
  }
}