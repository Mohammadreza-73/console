<?php

namespace App\Commands;

use Minicli\CommandController;

class HelloController extends CommandController
{
    public function run($argv)
    {
        $name = $argv[2] ?? 'World';
        $this->getApp()->getPrinter()->display("Hello {$name}\n");
    }
}