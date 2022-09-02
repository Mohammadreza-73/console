<?php

namespace Minicli;

class CliPrinter
{
    public function out($msg)
    {
        echo $msg;
    }

    public function newLine()
    {
        $this->out("\n");
    }

    public function display($msg)
    {
        $this->newLine();
        $this->out($msg);
        $this->newLine();
        $this->newLine();
    }
}