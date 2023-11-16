<?php
/**
 * Site base controller
 * @package site
 * @version 0.0.1
 */

namespace Site;

use LibView\Library\View;

class Controller extends \Mim\Controller
    implements \Mim\Iface\GateController
{
    public function show404(): void{
        $this->res->setStatus(404);
        $this->res->addContent('<h1>Not found</h1>');
        $this->res->send();
    }

    public function show404Action(): void{
        $this->show404();
    }

    public function show500(object $error): void{
        $tx = $error->text;
        $tx.= '<br>';
        $tx.= 'File: ' . $error->file . ' (' . $error->line . ')';
        if(isset($error->trace)){
            $tx.= '<ul>';
            foreach($error->trace as $trace){
                if(!isset($trace['file']))
                    continue;
                $tx.= '<li>' . $trace['file'] . '(' . $trace['line'] . ')' . '</li>';
            }
            $tx.= '</ul>';
        }

        $this->res->addContent($tx);
        $this->res->send();
    }

    public function show500Action(): void{
        $this->show500(\Mim\Library\Logger::$last_error);
    }

    public function resp(string $view, array $params=[], string $layout='default'){
        if(!isset($params['_meta']))
            $params['_meta'] = [];
        if(!isset($params['_meta']['title']))
            $params['_meta']['title'] = $this->config->name;

        $thumb_icon = $this->router->asset('admin', 'icon/file.png', 1);

        
        // render the content
        $content = View::render($view, $params, 'site') ?? '';

        $layout_params = [
            'meta'   => $params['meta'],
            '_meta'   => $params['_meta'],
            'content' => $content
        ];
        $result  = View::render('layout/' . $layout, $layout_params) ?? '';

        $this->res->addContent($result);
        $this->res->send();
    }
}