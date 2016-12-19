<?php

Class MypageController extends BaseController
{

    public function index()
    {
        $this->data['title'] = 'Mypage';
        
        App::render('index.twig', $this->data);
    }
}