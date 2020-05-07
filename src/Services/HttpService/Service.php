<?php

namespace Ilma\Ecosystem\Services\HttpService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Container\BindingResolutionException;

class Service implements ServiceInterface
{
    /**
     * @var string
     */
    protected $accept = 'application/json';

    /**
     * @var string
     */
    protected $apiToken;

    /**
     * @param string $url
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function get(string $url): string
    {
        $request = $this->getClient()->get(
            $url,
            [
                'headers' => $this->getHeaders()
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param array $formData
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function post(string $url, array $formData = []): string
    {
        $request = $this->getClient()->post(
            $url,
            [
                'headers' => $this->getHeaders(),
                'form_params' => $formData
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param array $formData
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function put(string $url, array $formData = []): string
    {
        $formData['_method'] = 'PUT';

        $request = $this->getClient()->post(
            $url,
            [
                'headers' => $this->getHeaders(),
                'form_params' => $formData
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param array $formData
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function multipartPost(string $url, array $formData = []): string
    {
        $request = $this->getClient()->post(
            $url,
            [
                'headers' => $this->getHeaders(),
                'multipart' =>  $formData
            ]
        );
        return $request->getBody()->getContents();
    }

    /**
     * @param string $url
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function delete(string $url): string
    {
        $request = $this->getClient()->post(
            $url,
            [
                'headers' => $this->getHeaders(),
                'form_params'=>[
                    '_method'=>'DELETE'
                ]
            ]
        );
        return $request->getBody()->getContents();
    }

    private function getHeaders(): array
    {
        $data = [];
        if ($this->accept){
            $data['Accept'] = $this->accept;
        }
        if ($this->apiToken){
            $data['Authorization'] = 'Bearer '.$this->apiToken;
        }
        return $data;
    }

    public function setAccept(string $accept): Service
    {
        $this->accept = $accept;
        return $this;
    }

    public function setApiToken(string $apiToken): Service
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    /**
     * @return Client
     * @throws BindingResolutionException
     */
    private function getClient(): Client
    {
        return app()->make(Client::class);
    }
}
