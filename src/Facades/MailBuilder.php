<?php

namespace Aridez\MailBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class MailBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mailbuilder';
    }
}