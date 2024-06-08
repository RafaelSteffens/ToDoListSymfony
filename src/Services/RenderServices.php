<?php

namespace App\Services;

use Twig\Environment;

class RenderServices
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function serviceRender(string $view): string
    {
        return $this->twig->render($view);
    }
}

