<?php

namespace App;

class View
{
    /**
     * génère le rendu d'une page a partir d'un template
     * @param string $template
     * @param array $data
     * @return void
     */
    public static function render(string $template, array $data): void
    {
        ob_start();
        extract($data);
        require_once "templates/{$template}.html.php";
        $pageContent = ob_get_clean();
        ob_start();
        require_once "templates/layout.html.php";
        echo ob_get_clean();
    }
}
