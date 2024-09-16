<?php

namespace Aridez\MailBuilder\Tests\Unit\Core;

use Aridez\MailBuilder\Core\MailMessageBuilder;
use PHPUnit\Framework\TestCase;

class MailMessageBuilderTest extends TestCase
{
    public function test_theme_method()
    {
        $builder = new MailMessageBuilder();
        $builder->theme('new_theme');

        $this->assertEquals('emailbuilder::components.mail.themes.new_theme.index', $builder->view);
    }

    public function test_brand_method()
    {
        $builder = new MailMessageBuilder();
        $builder->brand('http://example.com/image.png');

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.brand',
            'props' => ['image_url' => 'http://example.com/image.png'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_title_method()
    {
        $builder = new MailMessageBuilder();
        $builder->title('My Title');

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.title',
            'props' => ['title' => 'My Title'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_text_method()
    {
        $builder = new MailMessageBuilder();
        $builder->text('Some text');

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.text',
            'props' => ['text' => 'Some text'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_button_method()
    {
        $builder = new MailMessageBuilder();
        $builder->button('Click Me', 'http://example.com');

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.button',
            'props' => ['button_text' => 'Click Me', 'button_url' => 'http://example.com'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_link_method()
    {
        $builder = new MailMessageBuilder();
        $builder->link('Visit Site', 'http://example.com');

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.link',
            'props' => ['link_text' => 'Visit Site', 'link_url' => 'http://example.com'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_italic_method()
    {
        $builder = new MailMessageBuilder();
        $builder->italic('Some italic text');

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.italic',
            'props' => ['text' => 'Some italic text'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_space_method()
    {
        $builder = new MailMessageBuilder();
        $builder->space(20);

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.space',
            'props' => ['space' => 20],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_component_method()
    {
        $builder = new MailMessageBuilder();
        $builder->component('custom_component', ['key' => 'value']);

        $expected = [
            'view' => 'emailbuilder::components.mail.themes.default.custom_component',
            'props' => ['key' => 'value'],
        ];
        $this->assertContains($expected, $builder->data()['components']);
    }

    public function test_include_method()
    {
        $builder = new MailMessageBuilder();
        $builder->include(['extra_data' => 'value']);

        $this->assertArrayHasKey('extra_data', $builder->data());
        $this->assertEquals('value', $builder->data()['extra_data']);
    }
}
