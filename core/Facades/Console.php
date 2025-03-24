<?php

namespace Core\Facades;

class Console
{
    public static function add(string $commandClass)
    {
        app()->get('console')
            ->add(new $commandClass());
    }
}