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

use Vainyl\Http\Provider\HeaderProviderInterface;

/**
 * Class CannotExtractHeadersException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CannotExtractHeadersException extends AbstractHeaderProviderException
{
    private $data;

    /**
     * CannotExtractHeadersException constructor.
     *
     * @param HeaderProviderInterface $provider
     * @param array                   $data
     */
    public function __construct(HeaderProviderInterface $provider, array $data)
    {
        $this->data = $data;
        parent::__construct($provider, sprintf('Cannot extract headers from data'));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['data' => $this->data], parent::toArray());
    }
}
