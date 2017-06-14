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

namespace Vainyl\Http\Extension;

use Vainyl\Core\Extension\AbstractExtension;

/**
 * Class HttpExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [new HeaderProviderCompilerPass()];
    }
}