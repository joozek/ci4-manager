<?php

namespace App\Adds;

/**
 * This is a export buttons class used to create export buttons.
 */
class ExportButtons
{
    /**
     * Create Export buttons
     *
     * @return string
     */
    private function createExportButtons(): string
    {
        return <<<'HTML'
          <div id="export" method="POST" action="" class="buttons">
              <button class="button export" name="json">Export (.json)</button>
              <button class="button export" name="xlsx">Export (.xlsx)</button>
              <button class="button export" name="docx">Export (.docx)</button>
              <script>
                const btns = document.querySelectorAll('#export > button');
                const form = document.querySelector('#search');
                
                btns.forEach((btn) => {
                  btn.addEventListener('click', (ev) => {
                    const regexp = /\/(\w*)(\?|$)/;
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

    /**
     * Get created export buttons
     *
     * @return string
     */
    public function getExportButtons()
    {
        return $this->createExportButtons();
    }
}
