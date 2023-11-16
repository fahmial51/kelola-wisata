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
        $json = '{
            "version": "2.3",
            "comment": "---Above version must be the same as data-pwa-version",
            "lang" : "en",
            "name" : "'.$this->setting->{'frontpage_title'}.'",
            "scope" : "https://kelola-wisata.bisabanget.my.id/",
            "display" : "fullscreen",
            "start_url" : "https://kelola-wisata.bisabanget.my.id/",
            "short_name" : "'.$this->setting->{'frontpage_title'}.'",
            "description" : "",
            "orientation" : "portrait",
            "background_color": "#000000",
            "theme_color": "#000000",
            "generated" : "true",
              "icons": [
                {
                  "src": "theme/site/static/favicon_io/16x16.png",
                  "sizes": "16x16",
                  "type": "image/png",
                  "purpose": "any maskable"
                },
                {
                  "src": "theme/site/static/favicon_io/32x32.png",
                  "sizes": "32x32",
                  "type": "image/png",
                  "purpose": "any maskable"
                },
                {
                  "src": "theme/site/static/favicon_io/192x192.png",
                  "sizes": "192x192",
                  "type": "image/png",
                  "purpose": "any maskable"
                },
                {
                  "src": "theme/site/static/favicon_io/192x192.png",
                  "sizes": "144x144",
                  "type": "image/png",
                  "purpose": "any maskable"
                },
                {
                  "src": "'.($this->setting->{'pwa_splashscreen'} ?? 'theme/site/static/favicon_io/512x512.png').'",
                  "sizes": "512x512",
                  "type": "image/png",
                  "purpose": "any maskable"
                },
                {
                  "src": "theme/site/static/favicon_io/favicon.ico",
                  "sizes": "any"
                }
              ]
            }';

            $this->res->addHeader('Content-Type', 'application/json; charset=utf-8');
            $this->res->addContent($json);
            $this->res->send();
    }

    public function serviceWorkerAction(){
        return '';
    }
}