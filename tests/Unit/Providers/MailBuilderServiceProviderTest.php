<?php

namespace Aridez\MailBuilder\Tests\Unit\Providers;

use Aridez\MailBuilder\Core\MailMessageBuilder;
use Aridez\MailBuilder\Tests\TestCase;

class MailBuilderServiceProviderTest extends TestCase
{

    public function test_it_correctly_resolves_facade()
    {
        $this->assertInstanceOf(MailMessageBuilder::class, app('mailbuilder'));
    }
}
