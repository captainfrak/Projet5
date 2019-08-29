<?php


namespace Controllers;
abstract class Controller
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem("../Views");
        $this->twig = new \Twig_Environment($loader, ["cache" => false]);
    }
    public function render($filename, $args = array())
    {
        echo $this->twig->render($filename, $args);
    }
}