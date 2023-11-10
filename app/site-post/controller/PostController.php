<?php
/**
 * PostController
 * @package site-post
 * @version 0.0.1
 */

namespace SitePost\Controller;

use SitePost\Library\Meta;
use Post\Model\Post;
use Contact\Library\Contact;
use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibRecaptcha\Library\Validator;

class PostController extends \Site\Controller
{
    public function listAction(){
        if(empty($this->req->param->type)) {
            $this->req->param->type = 1;
        }

        switch($this->req->param->type) {
            case 'destination':
                $type = 1;
                $type_text = 'Destinasi';
                break;
            case 'information':
                $type = 2;
                $type_text = 'Informasi';
                break;
            case 'hotel':
                $type = 3;
                $type_text = 'Hotel';
                break;
            case 'activity':
                $type = 4;
                $type_text = 'Aktivitas';
                break;
            default:
                $type = 1;
                $type_text = 'Destinasi';
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

        if($type==4) {
            return $this->resp('post/activity-list', $params);
        }
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

        if($post->type == 4) {
            $form = new Form('site-contact');

            $params = [
                'post' => $post,
                'meta'    => Meta::single($post),
                'form'    => $form,
                'error'   => null,
                'success' => null
            ];
            if(!is_null($fields = $form->validate())){
                if(module_exists('lib-recaptcha')){
                    $token = $this->req->getPost('secure');
                    if(is_null(Validator::validate($token))){
                        $params['error'] = 'Invalid Credentials';
                        $this->res->render('contact/single', $params);
                        return $this->res->send();
                    }
                }

                if(!Contact::add((array)$fields)){
                    $params['error'] = Contact::$last_error;
                    return $this->resp('post/activity', $params);
                }

                $params['success'] = true;
            }
            return $this->resp('post/activity', $params);
        }
        return $this->resp('post/single', $params);
    }
}