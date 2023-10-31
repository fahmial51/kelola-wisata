<?php
/**
 * MigrateController
 * @package cli-app-model
 * @version 0.0.1
 */

namespace CliAppModel\Controller;

use Cli\Library\Bash;

class MigrateController extends \CliApp\Controller
{

    private function canRunHere(): ?string{
        $here = getcwd();
        // make sure this is app base
        if(!$this->isAppBase($here))
            Bash::error('Please run the command under exists application');

        // make sure module lib-model is installed here
        if(!is_dir($here . '/modules/lib-model'))
            Bash::error('Module `lib-model` is not installed on the app');
        if(!is_dir($here . '/modules/cli'))
            Bash::error('Module `cli` is not installed on the app');

        return $here;
    }

    public function dbAction(){
        $here = $this->canRunHere();
        $cmd = 'php index.php';

        $opt = getopt('', ['table::']);
        if($opt)
            $cmd.= ' --table=' . $opt['table'];
        $cmd.= ' migrate db';
        echo `$cmd`;
    }

    public function schemaAction() {
        $here = $this->canRunHere();
        $cmd = 'php index.php';

        $opt = getopt('', ['table::']);
        if($opt)
            $cmd.= ' --table=' . $opt['table'];
        $cmd.=  ' migrate schema ' . $this->req->param->dirname;
        echo `$cmd`;
    }

    public function startAction() {
        $here = $this->canRunHere();
        $cmd = 'php index.php';

        $opt = getopt('', ['table::']);
        if($opt)
            $cmd.= ' --table=' . $opt['table'];
        $cmd.=  ' migrate start';

        echo `$cmd`;
    }

    public function testAction() {
        $here = $this->canRunHere();
        $cmd = 'php index.php';

        $opt = getopt('', ['table::']);
        if($opt)
            $cmd.= ' --table=' . $opt['table'];
        $cmd.=  ' migrate test';
        
        echo `$cmd`;
    }
}