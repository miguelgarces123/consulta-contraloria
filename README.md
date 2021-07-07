# Consultar registro contraloría

Paquete para consultas en la pagina de Contraloría Colombia con Laravel 6 o superior

## Requerimientos

* Se requiere PHP 7.1 o superior.

## Instalación

Agregar `miguelgarces`/`consulta-contraloria` como una dependencia requerida en su archivo `composer.json`:

    composer require miguelgarces/consulta-contraloria

## Uso

### Consulta por NIT

Para consultar Contraloria por nit solo es necesario utilizar el facade: `ConsultaContraloriaNit`

    use ConsultaContraloriaNit;
    $respuesta = ConsultaContraloriaNit::consultar(123456789);




