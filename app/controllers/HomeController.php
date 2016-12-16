<?php

Class HomeController extends BaseController
{

    public function welcome()
    {
        $this->data['title'] = 'Candy Clip';
        App::render('index.twig', $this->data);
    }
}