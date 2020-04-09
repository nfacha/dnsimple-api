<?php

use Curl\Curl;

class dnSimpleApi {
    private $apiKey;
    private $accountId;
    private $apiUrl = 'https://api.dnsimple.com/v2/';

    /**
     * dnSimpleApi constructor.
     *
     * @param $apiKey
     * @param $accountId
     */
    public function __construct( $apiKey, $accountId ) {
        $this->apiKey    = $apiKey;
        $this->accountId = $accountId;
    }

    private function getHeaders() {
        return [
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $this->apiKey
        ];
    }

    public function listRecords( $domainName ) {
        $curl = new Curl();
        $curl->setHeaders( $this->getHeaders() );
        $curl->get( $this->apiUrl . '/' . $this->accountId . '/zones/' . $domainName . '/records' );
        if ( $curl->httpStatusCode !== 200 ) {
            throw new Exception( 'Failed to list DNS zones, got ' . $curl->httpStatusCode );
        }

        return json_decode( json_encode( $curl->response ), true );
    }

    public function createRecord( $domainName, $recordConfig ) {
        $curl = new Curl();
        $curl->setHeaders( $this->getHeaders() );
        $curl->post( $this->apiUrl . '/' . $this->accountId . '/zones/' . $domainName . '/records', json_encode( $recordConfig ) );
        if ( $curl->httpStatusCode !== 201 ) {
            throw new Exception( 'Failed to create DNS zone, got ' . $curl->httpStatusCode );
        }

        return json_decode( json_encode( $curl->response ), true );
    }

    public function deleteRecord( $domainName, $recordId ) {
        $curl = new Curl();
        $curl->setHeaders( $this->getHeaders() );
        $curl->delete( $this->apiUrl . '/' . $this->accountId . '/zones/' . $domainName . '/records/' . $recordId );
        if ( $curl->httpStatusCode !== 204 ) {
            throw new Exception( 'Failed to delete DNS zone, got ' . $curl->httpStatusCode );
        }

        return json_decode( json_encode( $curl->response ), true );
    }


}