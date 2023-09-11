<?php

namespace App\Http\Controllers;

use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class FrontController extends Controller
{
    public function index()
    {
        $data = [
            'title' => '- Homepage'
        ];
        return view('pages.landing_page.index', $data);
    }
}
