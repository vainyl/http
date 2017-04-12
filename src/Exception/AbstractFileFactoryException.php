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

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Http\Factory\FileFactoryInterface;

/**
 * Class AbstractFileFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractFileFactoryException extends AbstractCoreException implements FileFactoryExceptionInterface
{
    private $fileFactory;

    /**
     * AbstractFileFactoryException constructor.
     *
     * @param FileFactoryInterface $fileFactory
     * @param string               $message
     * @param int                  $code
     * @param \Exception|null      $previous
     */
    public function __construct(
        FileFactoryInterface $fileFactory,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->fileFactory = $fileFactory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getFileFactory(): FileFactoryInterface
    {
        return $this->fileFactory;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['file_factory' => $this->fileFactory->getId()], parent::toArray());
    }
}