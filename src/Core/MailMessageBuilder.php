<?php

namespace Aridez\MailBuilder\Core;

class MailMessageBuilder extends BaseMailMessage
{

    /**
     * The view to be rendered.
     * Extended from the base class to give a default value pertaining to this package.
     *
     * @var string
     */
    public string $view = "mailbuilder::components.themes.default.index";

    /**
     * The theme this component is using
     *
     * @var string
     */
    protected string $theme = "default";

    /**
     * The data passed to the view.
     * Extended from the base class to give the default structure we use to configure the view.
     *
     * @var array
     */
    protected array $data = ['components' => []];

    /**
     * Changes the theme of the email view
     *
     * @param string $theme The name of the folder containing this theme
     * @return self
     */
    public function theme(string $theme): self
    {
        $this->theme = $theme;
        $this->view = "mailbuilder::components.themes.{$this->theme}.index";
        return $this;
    }

    /**
     * Inserts the brand image component to be rendered
     *
     * @param string $image_url
     * @return self
     */
    public function brand(string $image_url): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.brand",
            'props' => [
                'image_url' => $image_url,
            ],
        ];
        return $this;
    }

    /**
     * Inserts the title component to be rendered
     *
     * @param string $title
     * @return self
     */
    public function title(string $title): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.title",
            'props' => [
                'title' => $title,
            ],
        ];
        return $this;
    }

    /**
     * Inserts a text component to be rendered
     *
     * @param string $text
     * @return self
     */
    public function text(string $text): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.text",
            'props' => [
                'text' => $text,
            ],
        ];
        return $this;
    }

    /**
     * Inserts a clickable button component to be rendered
     *
     * @param string $button_text
     * @param string $button_url
     * @return self
     */
    public function button(string $button_text, string $button_url): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.button",
            'props' => [
                'button_text' => $button_text,
                'button_url' => $button_url,
            ],
        ];
        return $this;
    }

    /**
     * Inserts a clickable button component to be rendered
     *
     * @param string $link_text
     * @param string $link_url
     * @return self
     */
    public function link(string $link_text, string $link_url): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.link",
            'props' => [
                'link_text' => $link_text,
                'link_url' => $link_url,
            ],
        ];
        return $this;
    }

    /**
     * Inserts a text component to be rendered
     *
     * @param string $text
     * @return self
     */
    public function italic(string $text): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.italic",
            'props' => [
                'text' => $text,
            ],
        ];
        return $this;
    }

    /**
     * Inserts an empty space component to be rendered
     *
     * @param int $height The vertical space to add in pixels
     * @return self
     */
    public function space(int $height): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.space",
            'props' => [
                'height' => $height,
            ],
        ];
        return $this;
    }

    /**
     * Inserts an arbitrary component to be rendered
     *
     * @param string $name The name of the component to be used
     * @param array $props An array of key => value the component will receive as props
     * @return self
     */
    public function component(string $name, array $props = []): self
    {
        $this->data['components'][] = [
            'view' => "mailbuilder::components.themes.{$this->theme}.{$name}",
            'props' => $props,
        ];
        return $this;
    }

    /**
     * Appends an array of data to be accessed by the index template
     *
     * @param array $data
     * @return self
     */
    public function include(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }
}
