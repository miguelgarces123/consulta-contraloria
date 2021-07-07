<?php

namespace MiguelGarces\ConsultaContraloria\Consultas;


use Goutte\Client;
use Symfony\Component\DomCrawler\Field\InputFormField;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\HttpClient\HttpClient;

abstract class ConsultaContraloria
{

    protected $client;
    protected $token;
    protected $enlace_home = 'https://cfiscal.contraloria.gov.co/Certificados/CertificadoPersonaNatural.aspx';

    public function __construct() {
        
        $this->client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
    }

    /**
     * Funcion para crear formulario para consultas
     * @author Miguel Garces
     * @return Form
     */
    protected function createForm() : Form {
        $domDocument = new \DOMDocument;
        $domElement = $domDocument->createElement('form');
        $domElement->setAttribute('action', $this->enlace);
        $domElement->setAttribute('method', $this->method);
        $form = new Form($domElement, $this->enlace, $this->method);

        // Creacion de input de __RequestVerificationToken
        $domElement = $domDocument->createElement('input');
        $domElement->setAttribute('name', '__RequestVerificationToken');
        $domElement->setAttribute('value', $this->token);
        $formInput = new InputFormField($domElement);
        $form->set($formInput);

        return $form;
    }

}