<?php

namespace Minicli;

class App
{
    private $printer;
    private $command_registry = [];

    public function __construct()
    {
        $this->printer = new CliPrinter();
        $this->command_registry = new CommandRegistry();
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerController(string $command_name, CommandController $controller)
    {
        $this->command_registry->registerController($command_name, $controller);
    }

    public function registerCommand(string $command_name, $callable)
    {
        $this->command_registry->registerCommand($command_name, $callable);
    }

    public function getCommand(string $command_name)
    {
        return $this->command_registry[$command_name] ?? null;
    }
    
    public function runCommand(array $argv, $default_command = 'help')
    {
        $command_name = $default_command;
        if (isset($argv[1])) {
            $command_name = $argv[1];
        }
       
        try {
            call_user_func($this->command_registry->getCallable($command_name), $argv);
            
        } catch (\Exception $e) {
            $this->getPrinter()->display("Error: " . $e->getMessage());
            exit;
        }
    }
}