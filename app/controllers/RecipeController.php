<?php

Class RecipeController extends BaseController
{

    public function index()
    {
        $this->data['title'] = 'Recipe';
        App::render('index.twig', $this->data);
    }
}