<?php

namespace Minicli;

class CommandRegistry
{
    private $registry = [];

    public function registerCommand(string $command_name, $callable)
    {
        $this->registry[$command_name] = $callable;
    }

    public function getCommand($command)
    {
        return $this->registry[$command] ?? null;
    }
}