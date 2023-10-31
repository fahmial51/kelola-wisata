<?php
/**
 * CategoryController
 * @package api-post-category
 * @version 0.0.1
 */

namespace ApiPostCategory\Controller;

use LibFormatter\Library\Formatter;

use PostCategory\Model\PostCategory as PCategory;
use PostCategory\Model\PostCategoryChain as PCChain;
use Post\Model\Post;

class CategoryController extends \Api\Controller
{
    public function indexAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $cond = [];
        if($q = $this->req->getQuery('q'))
            $cond['q'] = $q;

        $pages = PCategory::get($cond, 0, 1, ['name' => true]);
        $pages = !$pages ? [] : Formatter::formatMany('post-category', $pages);

        foreach($pages as &$pg)
            unset($pg->content, $pg->meta, $pg->user);
        unset($pg);

        $this->resp(0, $pages, null, [
            'meta' => [
                'page'  => 1,
                'rpp'   => 0,
                'total' => PCategory::count($cond)
            ]
        ]);
    }

    public function singleAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;

        $page = PCategory::getOne(['id'=>$identity]);
        if(!$page)
            $page = PCategory::getOne(['slug'=>$identity]);

        if(!$page)
            return $this->resp(404);

        $page = Formatter::format('post-category', $page, ['user','parent']);

        $this->resp(0, $page);
    }

    public function postAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;

        $category = PCategory::getOne(['id'=>$identity]);
        if(!$category)
            $category = PCategory::getOne(['slug'=>$identity]);
        if(!$category)
            return $this->resp(404);

        $cond = [
            'post.status'   => 3,
            'post_category' => $category->id
        ];
        list($page, $rpp) = $this->req->getPager();

        $posts = [];
        $pages = PCChain::get($cond, $rpp, $page, ['post.created' => false]);
        if($pages){
            $post_ids = array_column($pages, 'post');
            $posts = Post::get(['id'=>$post_ids], 0, 1, ['created'=>false]);
            $posts = Formatter::formatMany('post', $posts, ['user','category']);

            foreach($posts as &$pg)
                unset($pg->meta);
            unset($pg);
        }

        $this->resp(0, $posts, null, [
            'meta' => [
                'page'  => $page,
                'rpp'   => $rpp,
                'total' => PCChain::count($cond)
            ]
        ]);
    }
}