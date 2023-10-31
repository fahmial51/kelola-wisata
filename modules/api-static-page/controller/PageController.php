<?php
/**
 * PageController
 * @package api-static-page
 * @version 0.0.1
 */

namespace ApiStaticPage\Controller;

use LibFormatter\Library\Formatter;

use StaticPage\Model\StaticPage as SPage;

class PageController extends \Api\Controller
{

    public function indexAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        list($page, $rpp) = $this->req->getPager();

        $cond = [];
        if($q = $this->req->getQuery('q'))
            $cond['q'] = $q;

        $pages = SPage::get($cond, $rpp, $page, ['title' => 'ASC']);
        $pages = !$pages ? [] : Formatter::formatMany('static-page', $pages);

        foreach($pages as &$pg)
            unset($pg->content, $pg->meta, $pg->user);
        unset($pg);

        $this->resp(0, $pages, null, [
            'meta' => [
                'page'  => $page,
                'rpp'   => $rpp,
                'total' => SPage::count($cond)
            ]
        ]);
    }

    public function singleAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;

        $page = SPage::getOne(['id'=>$identity]);
        if(!$page)
            $page = SPage::getOne(['slug'=>$identity]);

        if(!$page)
            return $this->resp(404);

        $page = Formatter::format('static-page', $page, ['user']);

        $this->resp(0, $page);
    }
}