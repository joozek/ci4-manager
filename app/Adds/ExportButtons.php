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
    return <<<END
    <form id="export" method="POST" action="" class="buttons">
        {$this->getHiddenPostFields()}
        <button class="button export">Export (.json)</button>
        <button class="button export">Export (.xlsx)</button>
        <button class="button export">Export (.csv)</button>
        <button class="button export">Export (.docx)</button>
        <script>
          const btns = document.querySelectorAll('.button');
          const form = document.querySelector('#export');

          btns.forEach((btn) => {
            btn.addEventListener('click', (ev) => {
              ev.preventDefault()
              const regexp = /\.[a-z]{3,4}/i;
              const action = btn.textContent.match(regexp)[0].slice(1, 5);

              if(action === 'docx') form.setAttribute('action', '/word');
              if(action === 'xlsx') form.setAttribute('action', '/excel');
              if(action === 'csv') form.setAttribute('action', '/excel?method=csv');
              if(action === 'json') form.setAttribute('action', '/json');

              form.submit();
            });
          });
        </script>
    </form>
    END;
  }

  public function getExportButtons() {
    return $this->createExportButtons();
  }
}