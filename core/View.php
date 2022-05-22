<?php

namespace Core;

class View
{
    private string $view;
    private array $params;
    private int $code;

    public function __construct($view, $params, $code)
    {
        $this->view = $view;
        $this->params = $params;
        $this->code = $code;
    }

    public function renderHtml(): void
    {
        http_response_code($this->code);
        extract($this->params);

        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/project/views/$this->view.php";
        $buffer = ob_get_clean();

        echo $buffer;
    }
}
