<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 06.04.19
 * Time: 7:55
 */

namespace Vendor\Sparrow\Console;


class ConsoleMain extends ConsoleCommandActions
{
    protected $argv;
    protected $additionalParameters;    // like -p
    protected $actions;

    protected $command;
    protected $parameter;

    protected $method = null;
    protected $arguments = null;

    protected function checkArguments(): void
    {
        $message = null;
        if (empty($this->argv)) {
            $this->showError('empty arguments');
        }
        elseif (empty($this->actions[$this->command])) {
            $message = 'action exists';
        } elseif (!$this->checkActionsExists()) {
            $message = 'action exists.';
        }

        !empty($message) ? $this->showError($message) : null;
    }

    protected function checkActionsExists(): bool
    {
        if (isset($this->actions[$this->command])
        && is_array($this->actions[$this->command])
            ? isset($this->actions[$this->command][$this->parameter])
            : true)
            return true;

        return false;
    }

    protected function splitCommand(): void
    {
        if (isset($this->argv[0])) {
            $splitArguments = explode(':', $this->argv[0]);
            $this->command = array_shift($splitArguments);
            $this->parameter = array_shift($splitArguments);
//            $this->parameter = explode(' ',array_shift($splitArguments))[0];
        }
        $this->additionalParameters = array_slice($this->argv, 1);
    }

    protected function getActions(): void
    {
        if (is_array($this->actions[$this->command])) {
            $this->method = $this->actions[$this->command][$this->parameter];
            $this->arguments = null;
        } else {
            $this->method = $this->actions[$this->command];
            $this->arguments = $this->parameter;
        }
    }

    protected function showError(string $message = null): void
    {
        $message = !empty($message) ? $message . $this->br : '';

$this->html = <<<HTML
            some error with parameters$this->br
            $message
HTML;

        $this->show();
        die();
    }

    protected function show(): void
    {
        echo $this->html;
    }

}
