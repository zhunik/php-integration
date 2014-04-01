<?php
namespace Svea;

require_once SVEA_REQUEST_DIR . '/Includes.php';

/**
 * Hosted Request is the parent of all hosted webservice requests
 * 
 * @author Kristian Grossman-Madsen
 */
class HostedRequest {

    /** @var ConfigurationProvider $config */
    protected $config;

    /** @var string $method  set by the subclass, defines what webservice is called (including payment) */
    protected $method;

    /** @var string $countryCode */
    protected $countryCode; 
        
    /** 
     * @param ConfigurationProvider $config
     */
    function __construct($config) {
        $this->config = $config;
    }
    
    /**
     * @param string $countryCode
     * @return $this
     */
    function setCountryCode( $countryCode ) {
        $this->countryCode = $countryCode;
        return $this;
    }
    
    /**
     * Performs a request using cURL, parsing the response using SveaResponse 
     * and returning the resulting HostedAdminResponse instance.
     * 
     * @return HostedAdminResponse
     */
    public function doRequest(){
        $fields = $this->prepareRequest();
        
        $fieldsString = "";
        foreach ($fields as $key => $value) {
            $fieldsString .= $key.'='.$value.'&';
        }
        rtrim($fieldsString, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config->getEndpoint(SveaConfigurationProvider::HOSTED_ADMIN_TYPE). $this->method);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //force curl to trust https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //returns a html page with redirecting to bank...
        $responseXML = curl_exec($ch);
        curl_close($ch);
        
        // create SveaResponse to handle annul response
        $responseObj = new \SimpleXMLElement($responseXML);        
        $sveaResponse = new \SveaResponse($responseObj, $this->countryCode, $this->config);

        return $sveaResponse->response; 
    }
}