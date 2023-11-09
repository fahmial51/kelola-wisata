<?php
/**
 * RobotController
 * @package admin-robot-txt
 * @version 0.0.1
 */

namespace AdminRobotTxt\Controller;

use LibForm\Library\Form;
use Mim\Library\Fs;

class RobotController extends \Admin\Controller
{
    public function editAction(){
        if(!$this->user->isLogin())
            return $this->loginFirst(1);
        if(!$this->can_i->update_robot_txt)
            return $this->show404();

        $form = new Form('admin.robottxt.create');
        $params = [
            '_meta' => [
                'title' => 'System Settings',
                'menus' => ['admin-setting']
            ],
            'form'  => $form,
            'success' => false
        ];

        $object = (object)[
            'value' => ''
        ];

        $robot_file = $this->config->adminRobotTxt->base;
        if(!$robot_file)
            $robot_file = BASEPATH;
        $robot_file.= '/robots.txt';
        $file_exists = is_file($robot_file);

        if($file_exists)
            $object->value = file_get_contents($robot_file);

        if(!($valid = $form->validate($object)) || !$form->csrfTest('noob'))
            return $this->resp('robot-txt/edit', $params);

        $diff_type = 2;

        $value = $valid->value;
        if(!$value){
            if($file_exists)
                unlink($robot_file);
            $diff_type = 3;
        }else{
            if(!$file_exists)
                $diff_type = 1;
            Fs::write($robot_file, $value);
        }

        $params['success'] = true;

        $this->addLog([
            'user'   => $this->user->id,
            'object' => 0,
            'parent' => 0,
            'method' => $diff_type,
            'type'   => 'robots.txt',
            'original' => $diff_type == 1 ? NULL : $object,
            'changes'  => $diff_type == 3 ? NULL : $valid
        ]);

        $this->resp('robot-txt/edit', $params);
    }
}