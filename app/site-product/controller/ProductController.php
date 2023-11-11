<?php
/**
 * ProductController
 * @package site-product
 * @version 0.0.1
 */

namespace SiteProduct\Controller;

use SiteProduct\Library\Meta;
use Product\Model\Product;
use Contact\Library\Contact;
use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibRecaptcha\Library\Validator;
use ProductLastSeen\Library\Seen;

class ProductController extends \Site\Controller
{
    public function listAction(){

        $cond = $pcond = ['status' => 2];
        list($page, $rpp) = $this->req->getPager(25, 50);

        $products = Product::get($cond, $rpp, $page, ['created'=>false]) ?? [];
        if($products){
            $products = Formatter::formatMany('product', $products, ['user']);
        }
        
        $params = [
            'products' => $products,
            '_meta' => [
                'title' =>  'Suvenir' 
            ]
        ];

        return $this->resp('product/list', $params);
    }

    public function singleAction() {
        $slug = $this->req->param->slug;

        $product = Product::getOne(['slug'=>$slug, 'status'=>2]);
        if(!$product)
            return $this->show404();

        if(module_exists('product-last-seen') && $this->user->isLogin())
            Seen::add($this->user->id, $product->id);

        $product = Formatter::format('product', $product, ['user']);
        $form = new Form('site-contact');

        $params = [
            'product' => $product,
            'meta'    => Meta::single($product),
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
                return $this->resp('product/single', $params);
            }

            $params['success'] = true;
        }

        return $this->resp('product/single', $params);
    }
}