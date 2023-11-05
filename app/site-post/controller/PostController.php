<?php
/**
 * PostController
 * @package site-post
 * @version 0.0.1
 */

namespace SitePost\Controller;

use SitePost\Library\Meta;
use Post\Model\Post;
use LibFormatter\Library\Formatter;

class PostController extends \Site\Controller
{
    public function listAction(){
        switch($this->req->param->type) {
            case 'destination':
                $type = 1;
                $type_text = 'Destination';
                break;
            case 'article':
                $type = 2;
                $type_text = 'Article & Event';
                break;
            case 'hotel':
                $type = 3;
                $type_text = 'Hotel';
            case 'tour-guide':
                $type = 4;
                $type_text = 'Tour Guide';
                break;
            default:
                $type = 1;
                $type_text = 'Destination';
                break;
        }

        $cond = $pcond = ['type' => $type];
        if($q = $this->req->getQuery('q'))
            $pcond['q'] = $cond['q'] = $q;

        if($status = $this->req->getQuery('status'))
            $pcond['status'] = $cond['status'] = $status;
        else
            $cond['status'] = ['__op', '>', 0];

        list($page, $rpp) = $this->req->getPager(25, 50);

        $posts = Post::get($cond, $rpp, $page, ['created'=>false]) ?? [];
        if($posts){
            $posts = Formatter::formatMany('post', $posts, ['user']);
        }
        $params = [
            'posts' => $posts,
            '_meta' => [
                'title' =>  $type_text
            ]
        ];

        return $this->resp('post/list', $params);
    }

    public function singleAction() {
        $slug = $this->req->param->slug;

        $post = Post::getOne(['slug'=>$slug, 'status'=>3]);
        if(!$post)
            return $this->show404();

        $post = Formatter::format('post', $post, ['user', 'content']);
        $params = [
            'post' => $post,
            'meta' => Meta::single($post)
        ];

        return $this->resp('post/single', $params);
    }
}