<?php
namespace App\services\renders;

class TwigTemplateRenderer
{
    public function renderTemplate($template, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('./../views/');
        $twig = new \Twig\Environment($loader, []);

        $template = $twig->load($template . '.html');

        echo $template->render($params);
    }
}