<?php

namespace As3\OmedaSDK\ApiResources;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class BrandResource extends AbstractResource
{
    /**
     * Performs a Brand Comprehensive Lookup
     *
     * @link    https://wiki.omeda.com/wiki/en/Brand_Comprehensive_Lookup_Service
     *
     * @return  \GuzzleHttp\Psr7\Response
     */
    public function lookup()
    {
        $endpoint = $this->client->buildBrandEndpoint('/comp/*');
        return $this->client->request('GET', $endpoint);
    }

    public function lookupBehavior()
    {
        $endpoint = $this->client->buildBrandEndpoint('/behavior/*');
        return $this->client->request('GET', $endpoint);
    }

    public function lookupBehaviorAction()
    {
        $endpoint = $this->client->buildBrandEndpoint('/behavior/action/*');
        return $this->client->request('GET', $endpoint);
    }

    public function lookupBehaviorAttribute()
    {
        $endpoint = $this->client->buildBrandEndpoint('/behavior/attribute/*');
        return $this->client->request('GET', $endpoint);
    }

    public function createBehaviorAction(array $payload)
    {

        if (empty($payload)) {

            $error_data['ErrorMessage'] = 'The behavior action description payload cannot be empty.';
            return json_decode(json_encode($error_data));
        }

        try {

            $endpoint = $this->client->buildBrandEndpoint('/behavior/action/*');
            return $this->client->request('POST', $endpoint, $payload);

        } catch (ClientException $e) {

            $error_data = ['ErrorCode' => $e->getCode()];

            $body = $this->client->parseApiResponse($e->getResponse());

            if (is_array($body) && isset($body['Errors']) && is_array($body['Errors'])) {
                foreach ($body['Errors'] as $error) {

                    $error_data['ErrorMessage'] = $error['Error'];
                    return json_decode(json_encode($error_data));
                }
                throw $e;
            }
            throw $e;
        }

    }

    public function createBehavior(array $payload)
    {

        if (empty($payload)) {

            $error_data['ErrorMessage'] = 'The behavior payload cannot be empty.';
            return json_decode(json_encode($error_data));
        }

        try {

            $endpoint = $this->client->buildBrandEndpoint('/behavior/*');
            return $this->client->request('POST', $endpoint, $payload);

        } catch (ServerException $e){

            $error_data = ['ErrorCode' => $e->getCode()];
            $body = $this->client->parseApiResponse($e->getResponse());

            if (is_array($body) && isset($body['Errors']) && is_array($body['Errors'])) {
                foreach ($body['Errors'] as $error) {

                    $error_data['ErrorMessage'] = $error['Error'];
                    return json_decode(json_encode($error_data));
                }
                throw $e;
            } else {

                if (500 == $e->getCode()) {
                    $error_data['ErrorMessage'] = '500 Internal Server Error. Check with Omeda or Variables';
                    return json_decode(json_encode($error_data));
                }
            }

            throw $e;

        } catch (ClientException $e) {

            $error_data = ['ErrorCode' => $e->getCode()];

            $body = $this->client->parseApiResponse($e->getResponse());

            if (is_array($body) && isset($body['Errors']) && is_array($body['Errors'])) {
                foreach ($body['Errors'] as $error) {

                    $error_data['ErrorMessage'] = $error['Error'];
                    return json_decode(json_encode($error_data));
                }
                throw $e;
            } else {

                if (404 != $e->getCode()) {
                    $error_data['ErrorMessage'] = 'Error message: ' . $e->getCode();
                    return json_decode(json_encode($error_data));
                }

            }
            throw $e;
        }

    }

    public function createBehaviorAttribute(array $payload)
    {

        if (empty($payload)) {

            $error_data['ErrorMessage'] = 'The attribute payload cannot be empty.';
            return json_decode(json_encode($error_data));
        }

        try {

            $endpoint = $this->client->buildBrandEndpoint('/behavior/attribute/*');
            return $this->client->request('POST', $endpoint, $payload);

        } catch (ServerException $e){

            $error_data = ['ErrorCode' => $e->getCode()];
            $body = $this->client->parseApiResponse($e->getResponse());

            if (is_array($body) && isset($body['Errors']) && is_array($body['Errors'])) {
                foreach ($body['Errors'] as $error) {

                    $error_data['ErrorMessage'] = $error['Error'];
                    return json_decode(json_encode($error_data));
                }
                throw $e;
            } else {

                if (500 == $e->getCode()) {
                    $error_data['ErrorMessage'] = '500 Internal Server Error. Check with Omeda';
                    return json_decode(json_encode($error_data));
                }
            }

            throw $e;
        } catch (ClientException $e) {

            $error_data = ['ErrorCode' => $e->getCode()];
            $body = $this->client->parseApiResponse($e->getResponse());

            if (is_array($body) && isset($body['Errors']) && is_array($body['Errors'])) {
                foreach ($body['Errors'] as $error) {

                    $error_data['ErrorMessage'] = $error['Error'];
                    return json_decode(json_encode($error_data));
                }
                throw $e;
            } else{

                if (404 != $e->getCode()) {
                    $error_data['ErrorMessage'] = 'Error message: ' . $e->getCode();
                    return json_decode(json_encode($error_data));
                }
            }

            throw $e;
        }

    }
}
