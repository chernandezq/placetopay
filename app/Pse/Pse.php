<?php

namespace App\Pse;

use SoapClient;

class Pse
{
    public $webService;

    /**
     * Pse constructor.
     */

    function __construct()
    {
        $service = "https://test.placetopay.com/soap/pse/?wsdl"; //url del servicio
        $param = array('trace' => true); //parametros de la llamada
        $this->webService = new SoapClient($service, $param);
        $this->webService->__setLocation('https://test.placetopay.com/soap/pse/');
    }

    /**
     * @return array
     */
    function auth()
    {
        $login = "6dd490faf9cb87a9862245da41170ff2"; // Identificador dado por PlaceToPay
        $seed = date('c'); // Instancio la semilla mediante date('c') el cual genera un timestamp en formato ISO 8601
        $tranKey = '024h1IlD';
        $tranKey = sha1($seed . $tranKey); // Obtengo el tranKey el cual es una encriptación de la semilla.
        $additional = array();
        $additional['name'] = 'tipoPago';
        $additional['value'] = 'débito';
        $authentication = array();
        $authentication['login'] = $login;
        $authentication['tranKey'] = $tranKey;
        $authentication['seed'] = $seed;
        $authentication['additional'] = $additional;
        $auth = array();
        $auth['auth'] = $authentication;

        return $auth;
    }

    /**
     * @param $auth
     * @return mixed
     */
    function getBankList($auth)
    {
        return $this->webService->getBankList($auth);
    }

    /**
     * @param $createTransaction
     * @return mixed
     */
    function createTransaction($createTransaction)
    {
        return $this->webService->createTransaction($createTransaction);
    }

    /**
     * @param $transaction
     * @return mixed
     */
    function getTransactionInformation($transaction)
    {
        return $this->webService->getTransactionInformation($transaction);
    }
}