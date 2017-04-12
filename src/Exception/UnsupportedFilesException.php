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

namespace Vainyl\Http\Exception;

use Vainyl\Http\Factory\FileFactoryInterface;

/**
 * Class UnsupportedFilesException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedFilesException extends AbstractFileFactoryException
{
    private $files;

    private $name;

    /**
     * UnsupportedFilesException constructor.
     *
     * @param FileFactoryInterface $fileFactory
     * @param array                $files
     * @param string               $name
     */
    public function __construct(FileFactoryInterface $fileFactory, array $files, string $name)
    {
        $this->files = $files;
        $this->name = $name;
        parent::__construct($fileFactory, sprintf('Cannot construct files from array at key %s', $name));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['files' => $this->files, 'name' => $this->name], parent::toArray());
    }
}