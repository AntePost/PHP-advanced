<?php
namespace App\services\renders;

class TemplateRenderer
{
    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include $_SERVER['DOCUMENT_ROOT'] . '/lesson_02/views/' . $template . '.php';
        return ob_get_clean();
    }
}