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

namespace Vainyl\Http\Stream;

/**
 * Class StringStream
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class StringStream implements VainStreamInterface
{
    private $string;

    private $currentPosition = 0;

    /**
     * StringStream constructor.
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @inheritDoc
     */
    public function __toString() : string
    {
        return $this->string;
    }

    /**
     * @inheritDoc
     */
    public function close() : VainStreamInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function detach() : VainStreamInterface
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSize() : int
    {
        return strlen($this->string);
    }

    /**
     * @inheritDoc
     */
    public function tell() : int
    {
        return $this->currentPosition;
    }

    /**
     * @inheritDoc
     */
    public function eof() : bool
    {
        return ($this->currentPosition > $this->getSize() - 1);
    }

    /**
     * @inheritDoc
     */
    public function isSeekable() : bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function seek($offset, $whence = SEEK_SET) : VainStreamInterface
    {
        switch ($whence) {
            case SEEK_SET:
                $this->currentPosition = $offset;
                break;
            case SEEK_CUR:
                $this->currentPosition += $offset;
                break;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rewind() : VainStreamInterface
    {
        $this->currentPosition = 0;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isWritable() : bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function write($string) : VainStreamInterface
    {
        $this->string = $string;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isReadable() : bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($length) : string
    {
        return substr($this->string, $this->currentPosition, $length);
    }

    /**
     * @inheritDoc
     */
    public function getContents() : string
    {
        return $this->string;
    }

    /**
     * @inheritDoc
     */
    public function getMetadata($key = null)
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getResource() : resource
    {
        return null;
    }
}