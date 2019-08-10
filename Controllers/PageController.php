<?php

namespace Controllers;

class PageController extends Controller
{
    public function homePage()
    {
        $this->render('index.html.twig', ['name' => 'Fabien']);
    }
}
