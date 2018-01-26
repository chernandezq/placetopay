<?php

namespace App\Http\Controllers;

use App\Pse\Pse;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SoapClient;

class HomeController extends Controller
{
    protected $soapWrapper;
    public $webService;

    const TRANKEY = '024h1IlD';
    const ID = '6dd490faf9cb87a9862245da41170ff2';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pse $pse)
    {
        //$this->middleware('auth');
        $this->pse = $pse;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = $this->pse->auth();
        $bankLlist = $this->pse->getBankList($auth);

        return view('home')->with(['banks' => $bankLlist->getBankListResult->item]);
    }

    public function createTransaction()
    {
        $data = $this->pse->auth();
        $data['transaction']['bankCode'] = 1040;
        $data['transaction']['bankInterface'] = 1;
        $data['transaction']['returnURL'] = 'http://placetopay.test/response';
        $data['transaction']['reference'] = '7456sdfssdf566';
        $data['transaction']['description'] = 'Pago de prueba';
        $data['transaction']['language'] = 'ES';
        $data['transaction']['currency'] = 'COP';
        $data['transaction']['totalAmount'] = 1000;
        $data['transaction']['taxAmount'] = 0;
        $data['transaction']['devolutionBase'] = 0;
        $data['transaction']['tipAmount'] = 0;

        $data['transaction']['payer']['document'] = '1122129750';
        $data['transaction']['payer']['documentType'] = 'CC';
        $data['transaction']['payer']['firstName'] = 'Cristian';
        $data['transaction']['payer']['lastName'] = 'Hernandez';
        $data['transaction']['payer']['company'] = '';
        $data['transaction']['payer']['emailAddress'] = 'ing.cristianh@gmail.com';
        $data['transaction']['payer']['address'] = 'Manzana N casa 167 reservas de yacare';
        $data['transaction']['payer']['city'] = 'Acacias';
        $data['transaction']['payer']['province'] = 'Meta';
        $data['transaction']['payer']['country'] = 'CO';
        $data['transaction']['payer']['phone'] = '3118093419';
        $data['transaction']['payer']['mobile'] = '3118093419';

        $data['transaction']['shipping']['document'] = '1122129750';
        $data['transaction']['shipping']['documentType'] = 'CC';
        $data['transaction']['shipping']['firstName'] = 'Cristian';
        $data['transaction']['shipping']['lastName'] = 'Hernandez';
        $data['transaction']['shipping']['company'] = '';
        $data['transaction']['shipping']['emailAddress'] = 'ing.cristianh@gmail.com';
        $data['transaction']['shipping']['address'] = 'Manzana N casa 167 reservas de yacare';
        $data['transaction']['shipping']['city'] = 'Acacias';
        $data['transaction']['shipping']['province'] = 'Meta';
        $data['transaction']['shipping']['country'] = 'CO';
        $data['transaction']['shipping']['phone'] = '3118093419';
        $data['transaction']['shipping']['mobile'] = '3118093419';

        $data['transaction']['buyer']['document'] = '1122129751';
        $data['transaction']['buyer']['documentType'] = 'CC';
        $data['transaction']['buyer']['firstName'] = 'Franco';
        $data['transaction']['buyer']['lastName'] = 'Hernandez';
        $data['transaction']['buyer']['company'] = '';
        $data['transaction']['buyer']['emailAddress'] = 'ing@gmail.com';
        $data['transaction']['buyer']['address'] = 'Manzana N casa 167 reservas de yacare';
        $data['transaction']['buyer']['city'] = 'Acacias';
        $data['transaction']['buyer']['province'] = 'Meta';
        $data['transaction']['buyer']['country'] = 'CO';
        $data['transaction']['buyer']['phone'] = '3118093419';
        $data['transaction']['buyer']['mobile'] = '3118093419';

        $data['transaction']['ipAddress'] = $_SERVER['REMOTE_ADDR'];
        $data['transaction']['userAgent'] = $_SERVER['HTTP_USER_AGENT'];;

        //dd($data);

        $transaction = $this->pse->createTransaction($data);

        dd($transaction);
    }

    public function responseTransaction()
    {
        dd(1);
    }

    public function transactionInformation()
    {
        $data = $this->pse->auth();
        $data['transactionID'] = '1454160655';

        $transactionInformation = $this->pse->getTransactionInformation($data);

        dd($transactionInformation);
    }
}
