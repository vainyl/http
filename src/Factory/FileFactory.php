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

use Psr\Http\Message\UploadedFileInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Http\Exception\UnsupportedFilesException;
use Vainyl\Http\File;

/**
 * Class FileFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class FileFactory extends AbstractIdentifiable implements FileFactoryInterface
{
    private $streamFactory;

    private $fileStorage;

    /**
     * FileFactory constructor.
     *
     * @param StreamFactoryInterface $streamFactory
     * @param StorageInterface       $fileStorage
     */
    public function __construct(StreamFactoryInterface $streamFactory, StorageInterface $fileStorage)
    {
        $this->streamFactory = $streamFactory;
        $this->fileStorage = $fileStorage;
    }

    /**
     * @param string|array $tmpName
     * @param int|array    $size
     * @param int|array    $error
     * @param string|array $name
     * @param string|array $type
     *
     * @return UploadedFileInterface[]|UploadedFileInterface
     */
    protected function processFile($tmpName, $size, $error, $name, $type)
    {
        if (false === is_array($tmpName)) {
            return $this->createFile($tmpName, $size, $error, $name, $type);
        }
        $files = [];
        foreach (array_keys($tmpName) as $tmpFileName) {
            $files[$tmpFileName] = $this->processFile(
                $tmpFileName,
                $size[$tmpFileName],
                $error[$tmpFileName],
                $name[$tmpFileName],
                $type[$tmpFileName]
            );
        }

        return $files;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): StorageInterface
    {
        $files = clone $this->fileStorage;
        foreach ($data as $key => $fileSpec) {
            switch (true) {
                case is_array($fileSpec) && array_key_exists('tmp_name', $fileSpec):
                    $files->offsetSet(
                        $key,
                        $this->processFile(
                            $fileSpec['tmp_name'],
                            $fileSpec['size'],
                            $fileSpec['error'],
                            $fileSpec['name'],
                            $fileSpec['type']
                        )
                    );
                    break;
                case is_array($fileSpec):
                    $files->offsetSet($key, $this->create($fileSpec));
                    break;
                default:
                    throw new UnsupportedFilesException($this, $data, $key);
            }
        }

        return $files;
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
        return new File(
            $this->streamFactory->createResource(fopen($source, 'r')),
            $size,
            $error,
            $fileName,
            $mediaType
        );
    }
}