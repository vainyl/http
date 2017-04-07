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

use Psr\Http\Message\UploadedFileInterface;

/**
 * Class CannotMoveFileException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CannotMoveFileException extends AbstractUploadedFileException
{
    private $destination;

    /**
     * CannotMoveFileException constructor.
     *
     * @param UploadedFileInterface $file
     * @param string                $destination
     */
    public function __construct(UploadedFileInterface $file, string $destination)
    {
        $this->destination = $destination;
        parent::__construct(
            $file,
            sprintf('Cannot move file %s to destination %s', $file->getClientFilename(), $destination)
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['destination' => $this->destination], parent::toArray());
    }
}
