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
declare(strict_types = 1);

namespace Vainyl\Http\Message;

use Psr\Http\Message\MessageInterface as HttpMessageInterface;
use Vain\Core\Display\DisplayableInterface;
use Vainyl\Http\Header\Storage\HeaderStorageInterface;
use Vainyl\Http\Header\VainHeaderInterface;
use Vainyl\Http\Stream\VainStreamInterface;

/**
 * Interface VainMessageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method VainHeaderInterface[] getHeaders
 */
interface VainMessageInterface extends HttpMessageInterface, DisplayableInterface
{
    const HEADER_CONTENT_TYPE = 'Content-Type';
    const HEADER_EXPIRES = 'Expires';
    const HEADER_LOCATION = 'Location';
    const HEADER_CONTENT_DESCRIPTION = 'Content-Description';
    const HEADER_CONTENT_DISPOSITION = 'Content-Disposition';
    const HEADER_CONTENT_TRANSFER_ENCODING = 'Content-Transfer-Encoding';
    const HEADER_CONTENT_LENGTH = 'Content-Length';
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';
    const CONTENT_TYPE_URL_ENCODED = 'application/x-www-form-urlencoded';
    const CONTENT_TYPE_FORM_DATA = 'multipart/form-data';
    const SUPPORTED_VERSIONS = ['1.0', '1.1', '2'];

    /**
     * @return HeaderStorageInterface
     */
    public function getHeaderStorage() : HeaderStorageInterface;

    /**
     * @return VainStreamInterface
     */
    public function getStream() : VainStreamInterface;

    /**
     * @param string $contentType
     *
     * @return mixed
     */
    public function withContentType(string $contentType) : VainMessageInterface;
}