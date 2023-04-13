<?php

use Goutte\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    $client = new Client();
    $crawler = $client->request('GET', 'https://www.filgoal.com/articles');

    $news = [];
    $crawler->filter('#list-box ul li')->each(function ($node) use (&$news) {
        $title = $node->filter('a div h6')->text();
        $image = 'http:' . $node->filter('a img')->attr('data-src');

        $news[] = compact('title', 'image');
    });

    return $news;
});
