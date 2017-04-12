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

namespace Vainyl\Http\Decorator;

use Psr\Http\Message\UploadedFileInterface;

/**
 * Class AbstractFileDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractFileDecorator implements UploadedFileInterface
{
    private $file;

    /**
     * AbstractFileDecorator constructor.
     *
     * @param UploadedFileInterface $uploadedFile
     */
    public function __construct(UploadedFileInterface $uploadedFile)
    {
        $this->file = $uploadedFile;
    }

    /**
     * @inheritDoc
     */
    public function getStream()
    {
        return $this->file->getStream();
    }

    /**
     * @inheritDoc
     */
    public function moveTo($targetPath)
    {
        return $this->file->moveTo($targetPath);
    }

    /**
     * @inheritDoc
     */
    public function getSize()
    {
        return $this->file->getSize();
    }

    /**
     * @inheritDoc
     */
    public function getError()
    {
        return $this->file->getError();
    }

    /**
     * @inheritDoc
     */
    public function getClientFilename()
    {
        return $this->file->getClientFilename();
    }

    /**
     * @inheritDoc
     */
    public function getClientMediaType()
    {
        return $this->file->getClientMediaType();
    }
}