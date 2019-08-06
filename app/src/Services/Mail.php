<?php

// Trochę nie bardzo mam czas żeby w tym zadaniu podpinac coś innego niż mail() XD

class Mail
{

    protected $subject;
    protected $message;
    protected $from;
    protected $to;

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function send()
    {

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';
        $headers[] = 'From: System email <' . $this->from . '>';

        return mail($this->to, $this->subject, $this->message, implode("\r\n", $headers));
    }
}