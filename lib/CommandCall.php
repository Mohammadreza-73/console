<?php

namespace Minicli;

class CommandCall
{
    public $command;
    public $subcommand;
    public $args = [];
    public $params = [];

    public function __construct(array $argv)
    {
        $this->args = $argv;
        $this->command = $argv[1] ?? null;
        $this->subcommand = $argv[2] ?? 'default';

        $this->loadParams($argv);
    }

    public function hasParam($param)
    {
        return isset($this->params[$param]);
    }

    public function getParam($param)
    {
        return $this->params[$param] ?? null;
    }

    private function loadParams(array $args)
    {
        foreach ($args as $arg) {
            $pair = explode('=', $arg);
            if (count($pair) == 2) {
                $this->params[$pair[0]] = $pair[1];
            }
        }
    }
}