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

namespace Vainyl\Http\Provider;

use Vainyl\Core\AbstractIdentifiable;

/**
 * Class ApacheHeaderProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApacheHeaderProvider extends AbstractIdentifiable implements HeaderProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'apache';
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(array $data): ?array
    {
        if (false === function_exists('getallheaders')) {
            return null;
        }

        return getallheaders();
    }
}