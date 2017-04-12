<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Http\Factory;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Http\Provider\HeaderProviderInterface;
use Vainyl\Http\ServerRequest;

/**
 * Class HttpFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpFactory extends AbstractIdentifiable implements HttpFactoryInterface
{
    private $headerProvider;

    private $requestFactory;

    private $responseFactory;

    private $uriFactory;

    private $headerFactory;

    private $cookieFactory;

    private $fileFactory;

    private $streamFactory;

    /**
     * HttpFactory constructor.
     *
     * @param HeaderProviderInterface  $headerProvider
     * @param RequestFactoryInterface  $requestFactory
     * @param ResponseFactoryInterface $responseFactory
     * @param UriFactoryInterface      $uriFactory
     * @param HeaderFactoryInterface   $headerFactory
     * @param CookieFactoryInterface   $cookieFactory
     * @param FileFactoryInterface     $fileFactory
     * @param StreamFactoryInterface   $streamFactory
     */
    public function __construct(
        HeaderProviderInterface $headerProvider,
        RequestFactoryInterface $requestFactory,
        ResponseFactoryInterface $responseFactory,
        UriFactoryInterface $uriFactory,
        HeaderFactoryInterface $headerFactory,
        CookieFactoryInterface $cookieFactory,
        FileFactoryInterface $fileFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->headerProvider = $headerProvider;
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
        $this->uriFactory = $uriFactory;
        $this->headerFactory = $headerFactory;
        $this->cookieFactory = $cookieFactory;
        $this->fileFactory = $fileFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @param string $requestMethod
     * @param array  $request
     * @param array  $get
     *
     * @return array
     */
    protected function getQueryParams(string $requestMethod, array $request, array $get): array
    {
        if ('get' === $requestMethod) {
            return $get;
        }

        return $request;
    }

    /**
     * @param string          $requestMethod
     * @param string          $contentType
     * @param StreamInterface $stream
     * @param array           $body
     *
     * @return array
     */
    protected function parseBody($requestMethod, $contentType, StreamInterface $stream, array $body)
    {
        if (false === in_array($requestMethod, ['post', 'put', 'patch'])) {
            return [];
        }

        if ('' === ($contents = $stream->getContents())) {
            return [];
        }

        switch ($contentType) {
            case ServerRequest::CONTENT_TYPE_URL_ENCODED:
            case ServerRequest::CONTENT_TYPE_FORM_DATA:
                if ($requestMethod === 'post') {
                    return $body;
                }
                $body = [];
                parse_str($contents, $body);

                return $body;
                break;
            case ServerRequest::CONTENT_TYPE_APPLICATION_JSON:
                return json_decode($contents, true);
                break;
            default:
                return $body;
                break;
        }
    }

    /**
     * @inheritDoc
     */
    public function createRequest(
        array $server,
        array $request,
        array $query,
        array $body,
        array $files,
        array $cookies
    ): ServerRequestInterface {

        $method = strtolower($server['REQUEST_METHOD']);
        $uri = $server['REQUEST_URI'];
        $contentType = $server['CONTENT_TYPE'] ?? '';
        $stream = $this->streamFactory->createResource(fopen('php://input', 'r'));

        $serverRequest = $this->requestFactory->createServerRequest($method, $this->uriFactory->createUri($uri));
        foreach ($this->headerProvider->getHeaders($server) as $headerName => $headerValue) {
            $serverRequest = $serverRequest->withHeader($headerName, $headerValue);
        }


        return $serverRequest
            ->withCookieParams((array)$this->cookieFactory->create($cookies))
            ->withUploadedFiles((array)$this->fileFactory->create($files))
            ->withBody($stream)
            ->withQueryParams($this->getQueryParams($method, $request, $query))
            ->withParsedBody($this->parseBody($method, $contentType, $stream, $body));
    }

    /**
     * @inheritDoc
     */
    public function createResponse(int $code = 200, array $headers, string $content): ResponseInterface
    {
        $response = $this->responseFactory->createResponse($code);
        foreach ($headers as $headerName => $headerValue) {
            $response = $response->withHeader($headerName, $headerValue);
        }
        $response->getBody()->write($content);

        return $response;
    }
}