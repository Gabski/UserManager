<?php
class ResponseJson implements ResponseInterface
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        header('Content-Type: application/json');
        echo json_encode($this->data);
    }

}