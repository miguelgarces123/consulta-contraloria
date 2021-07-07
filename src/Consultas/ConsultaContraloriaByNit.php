<?php

namespace MiguelGarces\ConsultaContraloria\Consultas;

use MiguelGarces\ConsultaContraloria\Exceptions\ResponseEmpty;
use MiguelGarces\ConsultaContraloria\Interfaces\ConsultaContraloriaByNitInterface;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\DomCrawler\Field\InputFormField;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Storage;

class ConsultaContraloriaByNit extends ConsultaContraloria implements ConsultaContraloriaByNitInterface 
{
    protected $enlace = 'https://cfiscal.contraloria.gov.co/Certificados/CertificadoPersonaNatural.aspx';
    protected $method = 'POST';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Funcion para consultar por nit
     * @author Miguel Garces
     * @param Int $nit Nit que se desea consultar
     * @return Object
     */
    public function consultar(Int $nit) {

        $crawler = $this->client->request('GET', $this->enlace_home);
        $form = $crawler->filter('#ctl01')->form();
        $form->setValues([
            'ctl00$MainContent$ddlTipoDocumento' => 1,
            'ctl00$MainContent$txtNumeroDocumento' => $nit
        ]);

        // Creacion de input de ctl00$MainContent$btnBuscar
        $domDocument = new \DOMDocument;
        $domElement = $domDocument->createElement('input');
        $domElement->setAttribute('name', 'ctl00$MainContent$btnBuscar');
        $domElement->setAttribute('value', 'Buscar');
        $formInput = new InputFormField($domElement);
        $form->set($formInput);
        $form->getFormNode()->setAttribute('action', $this->enlace);

        //dd($form->getValues());
        $this->client->submit($form);
        $res = $this->client->getInternalResponse()->getContent();

        if(!empty($res)){
            $file = 'miguelgarces/contraloria/'.(string)$nit.'.pdf';
            Storage::disk('public')->put($file, $res);
            $test = Pdf::getText(public_path('storage/'.$file), '/usr/local/bin/pdftotext');
            dd($test);
        }

        throw new ResponseEmpty('Respuesta vacia', $res);
    }


    /**
     * Funcion crear input de consulta a RUES
     * @author Miguel Garces
     * @param Form $form Formulario preconstruido
     * @param Int $nit Nit que se desea consultar
     * @return Void
     */
    private function setInput(Form &$form, Int $nit) : void{
        $domDocument = new \DOMDocument;
        // Creacion de input de nit
        $domElement = $domDocument->createElement('input');
        $domElement->setAttribute('name', $this->nameField);
        $domElement->setAttribute('value', $nit);
        $formInput = new InputFormField($domElement);
        $form->set($formInput);
    }

}