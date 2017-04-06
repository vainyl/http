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

use Vainyl\Core\Name\NameableInterface;

/**
 * Interface HeaderProviderInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HeaderProviderInterface extends NameableInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function getHeaders(array $data): ?array;
}