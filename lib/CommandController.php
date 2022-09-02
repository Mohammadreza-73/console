<?php

namespace Minicli;

abstract class CommandController
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getApp()
    {
        return $this->app;
    }

    abstract public function run($argv);
}