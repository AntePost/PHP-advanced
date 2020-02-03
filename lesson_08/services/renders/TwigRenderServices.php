<?php
namespace App\services\renders;

use Twig\Loader\FilesystemLoader;

class TwigRenderServices
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function renderTmpl($template, $params = [])
    {
        $loader = new FilesystemLoader([
            $this->config['viewsPath'] . '/twig/',
            $this->config['viewsPath'],
        ]);
        $twig = new \Twig\Environment($loader);
        $template .= '.twig';
        return $twig->render($template, $params);
    }
}
