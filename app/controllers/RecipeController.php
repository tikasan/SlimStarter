<?php

Class RecipeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    // getでrecipe/にアクセスされた場合
    // 検索画面
    public function index()
    {

    }

    // getでrecipe/createにアクセスされた場合
    // 入力画面と確認画面はここでする。
    public function create()
    {

    }

    // postでrecipe/にアクセスされた場合
    // 新規作成処理
    public function store()
    {

    }

    // getでrecipe/:idにアクセスされた場合
    // 詳細画面
    public function show($id)
    {

    }

    // getでrecipe/:id/editにアクセスされた場合
    // 編集画面
    public function edit($id)
    {

    }

    // putまたはpatchでrecipe/:idにアクセスされた場合
    // 更新処理
    public function update($id)
    {

    }

    // deleteでrecipe/:idにアクセスされた場合
    // 削除処理
    public function destroy($id)
    {

    }
}