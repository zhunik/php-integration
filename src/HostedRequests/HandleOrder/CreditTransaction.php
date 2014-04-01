<?php
namespace Svea;

require_once 'HostedRequest.php';
require_once SVEA_REQUEST_DIR . '/Includes.php';

/**
 * Credit a Card or Direct Bank transaction
 * 
 * @author Kristian Grossman-Madsen
 */
class CreditTransaction extends HostedRequest {

    protected $transactionId;
    protected $creditAmount;
    
    function __construct($config) {
        $this->method = "credit";
        parent::__construct($config);
    }

    /**
     * @param string $transactionId  the transaction to credit
     * @return $this
     */
    function setTransactionId( $transactionId ) {
        $this->transactionId = $transactionId;
        return $this;
    }
    
    /**
     * @param type $creditAmount  amount to credit, in minor currency (i.e. 1 SEK => 100 in minor currency)
     * @return $this
     */
    function setCreditAmount( $creditAmount ) {
        $this->creditAmount = $creditAmount;
        return $this;
    }
    
    /**
     * prepares the elements used in the request to svea
     */
    public function prepareRequest() {

        $xmlBuilder = new HostedXmlBuilder();
        
        // get our merchantid & secret
        $merchantId = $this->config->getMerchantId( \ConfigurationProvider::HOSTED_TYPE,  $this->countryCode);
        $secret = $this->config->getSecret( \ConfigurationProvider::HOSTED_TYPE, $this->countryCode);
        
        // message contains the credit request
        $messageContents = array(
            "transactionid" => $this->transactionId,
            "amounttocredit" => $this->creditAmount
        ); 
        $message = $xmlBuilder->getCreditTransactionXML( $messageContents );        

        // calculate mac
        $mac = hash("sha512", base64_encode($message) . $secret);
        
        // encode the request elements
        $request_fields = array( 
            'merchantid' => urlencode($merchantId),
            'message' => urlencode(base64_encode($message)),
            'mac' => urlencode($mac)
        );
        return $request_fields;
    }
}