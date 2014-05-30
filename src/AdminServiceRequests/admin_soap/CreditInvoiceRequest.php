<?php
namespace Svea\AdminSoap;

class CreditInvoiceRowsRequest {
    public $Authentication;     // note that the order of the attributes matter!
    public $ClientId;
    public $InvoiceDistributionType;
    public $InvoiceId;
    public $NewCreditInvoiceRows;
    public $RowNumbers;
    
    /**
     * AdminService CreditInvoiceRowsRequest 
     * 
     * @param Authentication $authentication
     * @param numeric $clientId
     * @param string $invoiceDistributionType
     * @param numeric $invoiceId
     * @param OrderRows $newCreditInvoiceRows
     * @param numeric[] $orderRowNumbers
     */
    function __construct( $authentication, $clientId, $invoiceDistributionType, $invoiceId, $newCreditInvoiceRows, $orderRowNumbers ) {
        
        $this->Authentication = new \SoapVar( $authentication, SOAP_ENC_OBJECT, 
                "-","--","Authentication","http://schemas.datacontract.org/2004/07/DataObjects.Admin.Service");
        $this->ClientId = new \SoapVar( $clientId, XSD_LONG, 
                "-","--","ClientId","http://schemas.datacontract.org/2004/07/DataObjects.Admin.Service");
        $this->InvoiceDistributionType = new \SoapVar( $invoiceDistributionType, XSD_STRING, 
                "-","--","InvoiceDistributionType","http://schemas.datacontract.org/2004/07/DataObjects.Admin.Service");   
        $this->InvoiceId = new \SoapVar( $invoiceId, XSD_LONG, 
                "-","--","InvoiceId","http://schemas.datacontract.org/2004/07/DataObjects.Admin.Service");
        $this->NewCreditInvoiceRows = new \SoapVar( $newCreditInvoiceRows, SOAP_ENC_OBJECT, 
                "-","--","NewCreditInvoiceRows","http://schemas.datacontract.org/2004/07/DataObjects.Admin.Service");
        $this->RowNumbers = new \SoapVar( $orderRowNumbers, SOAP_ENC_OBJECT, 
                "-","--","RowNumbers","http://schemas.datacontract.org/2004/07/DataObjects.Admin.Service");
    }
}