<?php

namespace App\Core;

use Config;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    private $data;
    private $config;
    public function data(array $data)
    {
        $this->data = (object) $data;

        return $this;
    }

    public function template($template)
    {
        if (!isset($this->data)) {
            throw new \Exception("Antes de chamar o template, passe os dados através do método data");
        }
    }

    public function send()
    {
        $arr = Config::config_email();
        $this->config = (object)$arr['email'];
        $mailer = new PHPMailer;
        //Server settings
        $mailer->SMTPDebug = 2; // Enable verbose debug output
        $mailer->isSMTP(); // Set mailer to use SMTP
        $mailer->Host = $this->config->host; // Specify main and backup SMTP servers
        $mailer->SMTPAuth = true; // Enable SMTP authentication
        $mailer->Username = $this->config->user; // SMTP username
        $mailer->Password = $this->config->password; // SMTP password
        $mailer->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mailer->Port = $this->config->port; // TCP port to connect to

        //Recipients
        $mailer->setFrom($this->data->fromEmail, $this->data->fromName);
        $mailer->addAddress($this->data->toEmail, $this->data->toName); // Add a recipient

        //Content
        $mailer->isHTML(true); // Set email format to HTML
        $mailer->Subject = 'Assunto';
        $mailer->Body = 'Template';
        $mailer->AltBody = 'Obrigado pelo contato';

        $mailer->send();
    }
}
