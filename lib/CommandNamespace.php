<?php

namespace Minicli;

class CommandNamespace
{
    private $name;
    private $controllers = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function loadControllers($commands_path)
    {
        foreach (glob($commands_path . '/' . $this->getName() . '/*Controller.php') as $controller_file) {
            $this->commandLoadMap($controller_file);
        }

        return $this->getControllers();
    }

    public function getControllers()
    {
        return $this->controllers;
    }

    public function getController($command_name)
    {
        return $this->controllers[$command_name] ?? null;
    }

    private function commandLoadMap($controller_file)
    {
        $controller_class = basename($controller_file, '.php');
        $command_name = strtolower(str_replace('Controller', '', $controller_class));
        $full_class_name = sprintf('App\\Commands\\%s\\%s', $this->getName(), $controller_class);

        /** @var CommandController $controller */
        $controller = new $full_class_name();
        $this->controllers[$command_name] = $controller;
    }
}