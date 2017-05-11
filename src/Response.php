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

namespace Vainyl\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Vainyl\Http\Factory\HeaderFactoryInterface;

/**
 * Class Response
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class Response extends AbstractMessage implements ResponseInterface
{
    const CODE_TO_MESSAGE
        = [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-status',
            208 => 'Already Reported',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => 'Switch Proxy',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Time-out',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Large',
            415 => 'Unsupported Media Type',
            416 => 'Requested range not satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'Unordered Collection',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',
            451 => 'Unavailable For Legal Reasons',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Time-out',
            505 => 'HTTP Version not supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            508 => 'Loop Detected',
            511 => 'Network Authentication Required',
        ];

    private $code;

    private $message;

    /**
     * AbstractResponse constructor.
     *
     * @param int                    $code
     * @param HeaderFactoryInterface $headerFactory
     * @param StreamInterface        $stream
     * @param \ArrayAccess           $headerStorage
     */
    public function __construct(
        int $code,
        HeaderFactoryInterface $headerFactory,
        StreamInterface $stream,
        \ArrayAccess $headerStorage
    ) {
        $this->code = $code;
        parent::__construct($headerFactory, $headerStorage, $stream);
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        if (false === array_key_exists($code, self::CODE_TO_MESSAGE)) {
            $code = 500;
        }
        if ('' === $reasonPhrase) {
            $reasonPhrase = self::CODE_TO_MESSAGE[$code];
        }
        $copy = clone $this;
        $copy->code = $code;
        $copy->message = $reasonPhrase;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase(): string
    {
        if (null !== $this->message) {
            return $this->message;
        }

        if (false === array_key_exists($this->code, self::CODE_TO_MESSAGE)) {
            return '';
        }

        return self::CODE_TO_MESSAGE[$this->code];
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['code' => $this->code, 'message' => $this->message], parent::toArray());
    }
}