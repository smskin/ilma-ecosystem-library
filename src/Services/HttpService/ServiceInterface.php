<?php

namespace Ilma\Ecosystem\Services\HttpService;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Container\BindingResolutionException;

interface ServiceInterface
{
    /**
     * @param string $url
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function get(string $url): string;

    /**
     * @param string $url
     * @param array $formData
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function post(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @param array $formData
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function put(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @param array $formData
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function multipartPost(string $url, array $formData = []): string;

    /**
     * @param string $url
     * @return string
     * @throws BindingResolutionException
     * @throws ClientException
     */
    public function delete(string $url): string;

    public function setAccept(string $accept): Service;
    public function setApiToken(string $apiToken): Service;
}
