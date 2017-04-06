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

use Vainyl\Core\Id\AbstractIdentifiable;

/**
 * Class ServerHeaderProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ServerHeaderProvider extends AbstractIdentifiable implements HeaderProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'server';
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(array $data): array
    {
        $headers = [];
        foreach ($data as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }
}