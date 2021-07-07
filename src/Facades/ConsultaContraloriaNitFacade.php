<?php

namespace MiguelGarces\ConsultaContraloria\Facades;

use Illuminate\Support\Facades\Facade;

class ConsultaContraloriaNitFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { 
        return 'ConsultaContraloriaByNit'; 
    }


}