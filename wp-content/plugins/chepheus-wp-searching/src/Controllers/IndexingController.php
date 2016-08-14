<?php

namespace App\Controllers;

class IndexingController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function actionIndexing()
    {
        var_dump('indexing'); exit;
    }
}