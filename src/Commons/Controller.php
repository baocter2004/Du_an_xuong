<?php
namespace Dell\DuAnXuong\Commons;
use eftec\bladeone\BladeOne;

class Controller 
{
    protected function rendViewClient ($view , $data = []) {
        $templatePath = __DIR__ . '/../Views/Client';
        $compiledPath = __DIR__ . '/../Views/Compiles';
        $blade = new BladeOne($templatePath , $compiledPath);

        echo $blade->run($view , $data);
    }

    protected function rendViewAdmin ($view , $data = []) {
        $templatePath = __DIR__ . '/../Views/Admin';
        $compiledPath = __DIR__ . '/../Views/Compiles';
        $blade = new BladeOne($templatePath , $compiledPath);

        echo $blade->run($view , $data);
    }
}

