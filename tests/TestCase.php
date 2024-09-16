<?php

namespace Aridez\MailBuilder\Tests;

use Aridez\MailBuilder\Providers\MailBuilderServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase

{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app): array
    {
        return [
            MailBuilderServiceProvider::class,
        ];
    }
    protected function getPackageAliases($app)
    {
        return [
            'EmailBuilder' => \Aridez\EmailBuilder\Facades\MailBuilder::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
