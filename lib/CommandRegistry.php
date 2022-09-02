<?php

namespace Minicli;

class CommandRegistry
{
    private $registry = [];
    private $controllers = [];

    public function registerController(string $command_name, CommandController $controller)
    {
        $this->controllers[$command_name] = $controller;
    }

    public function getController($name)
    {
        return $this->controllers[$name] ?? null;
    }

    public function registerCommand(string $command_name, $callable)
    {
        $this->registry[$command_name] = $callable;
    }

    public function getCommand($command)
    {
        return $this->registry[$command] ?? null;
    }

    public function getCallable(string $command_name)
    {
        $command = $this->getController($command_name);
        if ($command instanceof CommandController) {
            return [$command, 'run'];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            throw new \Exception("Error: Command '{$command_name}' not found!");
        }

        return $command;
    }
}