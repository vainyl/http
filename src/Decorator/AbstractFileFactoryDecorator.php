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
use Vainyl\Http\Factory\FileFactoryInterface;

/**
 * Class AbstractFileFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractFileFactoryDecorator implements FileFactoryInterface
{
    private $fileFactory;

    /**
     * AbstractFileFactoryDecorator constructor.
     *
     * @param FileFactoryInterface $fileFactory
     */
    public function __construct(FileFactoryInterface $fileFactory)
    {
        $this->fileFactory = $fileFactory;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->fileFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function create(array $files): \ArrayAccess
    {
        return $this->fileFactory->create($files);
    }

    /**
     * @inheritDoc
     */
    public function createFile(
        string $source,
        int $size,
        int $error,
        string $fileName,
        string $mediaType
    ): UploadedFileInterface {
        return $this->fileFactory->createFile($source, $size, $error, $fileName, $mediaType);
    }
}