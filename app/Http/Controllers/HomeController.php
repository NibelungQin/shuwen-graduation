<?php

namespace App\Http\Controllers;

use App\Model\Article;
use Illuminate\Http\Request;

/**
 * 首页显示
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    public function carousel()
    {
        $articles = Article::latest('created_at')->take(6)->get();
        return response()->json($articles);
    }
}
