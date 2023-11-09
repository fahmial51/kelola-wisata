<?php
/**
 * Default home controller
 * @package site
 * @version 0.0.1
 */

namespace Site\Controller;

use Site\Library\Meta;
use Post\Model\Post;
use Product\Model\Product;
use LibFormatter\Library\Formatter;

class HomeController extends \Site\Controller
{
    public function indexAction(){
        $destinations = Post::get(['status' => ['__op', '>', 0], 'type' => 1], 3, 1, ['created'=>false]) ?? [];
        if($destinations){
            $destinations = Formatter::formatMany('post', $destinations, ['user']);
        }

        $articles = Post::get(['status' => ['__op', '>', 0], 'type' => 2], 3, 1, ['created'=>false]) ?? [];
        if($articles){
            $articles = Formatter::formatMany('post', $articles, ['user']);
        }

        $hotels = Post::get(['status' => ['__op', '>', 0], 'type' => 3], 3, 1, ['created'=>false]) ?? [];
        if($hotels){
            $hotels = Formatter::formatMany('post', $hotels, ['user']);
        }

        $tour_guides = Post::get(['status' => ['__op', '>', 0], 'type' => 4], 3, 1, ['created'=>false]) ?? [];
        if($tour_guides){
            $tour_guides = Formatter::formatMany('post', $tour_guides, ['user']);
        }

        $products = Product::get( ['status' => 2], 5, 1, ['created'=>false]) ?? [];
        if($products){
            $products = Formatter::formatMany('product', $products, ['user']);
        }

        $params = [
            'destinations' => $destinations,
            'articles' => $articles,
            'hotels' => $hotels,
            'tour_guides' => $tour_guides,
            'products' => $products,
            'meta'  => Meta::single()
        ];

        return $this->resp('home/index', $params);
        // $this->res->setCache(86400);
        // $this->res->send();
    }

    public function manifestAction(){
        return '';
    }

    public function serviceWorkerAction(){
        return '';
    }
}