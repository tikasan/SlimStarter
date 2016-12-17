<?php

Class HomeController extends BaseController
{

    public function index()
    {
        $this->data['title'] = 'Candy Clip';
        App::render('index.twig', $this->data);
    }
}