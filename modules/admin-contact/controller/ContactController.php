<?php
/**
 * ContactController
 * @package admin-contact
 * @version 0.0.1
 */

namespace AdminContact\Controller;

use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibPagination\Library\Paginator;
use Contact\Model\Contact;
use Contact\Library\Contact as _C;

class ContactController extends \Admin\Controller
{
    private function getParams(string $title): array{
        return [
            '_meta' => [
                'title' => $title,
                'menus' => ['contact']
            ],
            'subtitle' => $title,
            'pages' => null
        ];
    }

    public function replyAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_contact)
            return $this->show404();

        $id = $this->req->param->id;
        $contact = Contact::getOne(['id'=>$id]);
        if(!$contact)
            return $this->show404();
        $params = $this->getParams('Reservation Details');

        if(is_null($contact->seen)){
            $contact->seen = date('Y-m-d H:i:s');
            Contact::set(['seen'=>$contact->seen], ['id'=>$id]);
        }

        $xcontact = clone $contact;

        $params['contact'] = Formatter::format('contact', $xcontact, ['user', 'post']);
        $params['form']    = null;

        if($contact->user)
            return $this->resp('contact/reply', $params);

        $form                 = new Form('admin-contact.reply');
        $params['form']       = $form;
        if(!($valid = $form->validate($contact)) || !$form->csrfTest('noob'))
            return $this->resp('contact/reply', $params);

        $reply = (array)$valid;
        $reply['user'] = $this->user->id;
        if(!_C::reply($contact, $reply))
            deb(( _C::$last_error ?? Contact::lastError() ));

        // add the log
        $this->addLog([
            'user'   => $this->user->id,
            'object' => $id,
            'parent' => 0,
            'method' => 2,
            'type'   => 'contact',
            'original' => $contact,
            'changes'  => $valid
        ]);

        $next = $this->router->to('adminContactReply', ['id'=>$id]);
        $this->res->redirect($next);
    }

    public function indexAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_contact)
            return $this->show404();

        $cond = $pcond = ['type' => 1];
        if($q = $this->req->getQuery('q'))
            $pcond['q'] = $cond['q'] = $q;

        if($status = $this->req->getQuery('status')) {
            if($status == 1) {
                $pcond['replyed'] = $cond['replyed'] =['__op', '=', NULL];
            } else if($status == 2) {
                $pcond['replyed'] = $cond['replyed'] = ['__op', '!=', NULL];
            }
        }
        
        list($page, $rpp) = $this->req->getPager(25, 50);

        $contacts = Contact::get($cond, $rpp, $page, ['created'=>false]) ?? [];
        if($contacts)
            $contacts = Formatter::formatMany('contact', $contacts, ['user', 'post']);

        $params             = $this->getParams('Activity Reservation');
        $params['contacts'] = $contacts;
        $params['form']     = new Form('admin-contact.index');
        $params['form']->validate( (object)$this->req->get() );

        // pagination
        $params['total'] = $total = Contact::count($cond);
        if($total > $rpp){
            $params['pages'] = new Paginator(
                $this->router->to('adminContact'),
                $total,
                $page,
                $rpp,
                10,
                $pcond
            );
        }

        $this->resp('contact/index', $params);
    }
    
    public function deliveryAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_contact)
            return $this->show404();

        $id = $this->req->param->id;
        $contact = Contact::getOne(['id'=>$id]);
        if(!$contact)
            return $this->show404();
        $params = $this->getParams('Order Details');

        if(is_null($contact->seen)){
            $contact->seen = date('Y-m-d H:i:s');
            Contact::set(['seen'=>$contact->seen], ['id'=>$id]);
        }

        $xcontact = clone $contact;

        $params['contact'] = Formatter::format('contact', $xcontact, ['user', 'post']);
        $params['form']    = null;

        if($contact->user)
            return $this->resp('order/reply', $params);

        $form                 = new Form('admin-contact.reply');
        $params['form']       = $form;
        if(!($valid = $form->validate($contact)) || !$form->csrfTest('noob'))
            return $this->resp('order/reply', $params);

        $reply = (array)$valid;
        $reply['user'] = $this->user->id;
        if(!_C::reply($contact, $reply))
            deb(( _C::$last_error ?? Contact::lastError() ));

        // add the log
        $this->addLog([
            'user'   => $this->user->id,
            'object' => $id,
            'parent' => 0,
            'method' => 2,
            'type'   => 'contact',
            'original' => $contact,
            'changes'  => $valid
        ]);

        $next = $this->router->to('adminOrderDelivery', ['id'=>$id]);
        $this->res->redirect($next);
    }

    public function orderAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_contact)
            return $this->show404();

        $cond = $pcond = ['type' => 2];
        if($q = $this->req->getQuery('q'))
            $pcond['q'] = $cond['q'] = $q;

        if($status = $this->req->getQuery('status')) {
            if($status == 1) {
                $pcond['replyed'] = $cond['replyed'] =['__op', '=', NULL];
            } else if($status == 2) {
                $pcond['replyed'] = $cond['replyed'] = ['__op', '!=', NULL];
            }
        }
        
        list($page, $rpp) = $this->req->getPager(25, 50);

        $contacts = Contact::get($cond, $rpp, $page, ['created'=>false]) ?? [];
        if($contacts)
            $contacts = Formatter::formatMany('contact', $contacts, ['user', 'post']);

        $params             = $this->getParams('Product Order');
        $params['contacts'] = $contacts;
        $params['form']     = new Form('admin-contact.index');
        $params['form']->validate( (object)$this->req->get() );

        // pagination
        $params['total'] = $total = Contact::count($cond);
        if($total > $rpp){
            $params['pages'] = new Paginator(
                $this->router->to('adminContact'),
                $total,
                $page,
                $rpp,
                10,
                $pcond
            );
        }

        $this->resp('order/index', $params);
    }

    public function removeAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->manage_contact)
            return $this->show404();

        $id      = $this->req->param->id;
        $contact = Contact::getOne(['id'=>$id]);
        $next    = $this->router->to('adminContact');
        $form    = new Form('admin-contact.index');

        if(!$form->csrfTest('noob'))
            return $this->res->redirect($next);

        // add the log
        $this->addLog([
            'user'   => $this->user->id,
            'object' => $id,
            'parent' => 0,
            'method' => 3,
            'type'   => 'contact',
            'original' => $contact,
            'changes'  => null
        ]);

        Contact::remove(['id'=>$id]);
        
        $this->res->redirect($next);
    }
}