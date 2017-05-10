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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Vainyl\Core\Application\EnvironmentInterface;
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
    public function load(
        array $configs,
        ContainerBuilder $container,
        EnvironmentInterface $environment = null
    ): AbstractExtension {
        $container->addCompilerPass(new HeaderProviderCompilerPass());

        $container->setAlias('emitter.factory', 'emitter.factory.sapi');

        return parent::load($configs, $container, $environment);
    }
}