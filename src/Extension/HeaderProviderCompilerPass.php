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

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Extension\Exception\MissingRequiredFieldException;
use Vainyl\Core\Extension\Exception\MissingRequiredServiceException;

/**
 * Class HeaderProviderCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HeaderProviderCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->has('header.provider.chain')) {
            throw new MissingRequiredServiceException($container, 'header.provider.chain');
        }

        $definition = $container->getDefinition('header.provider.chain');
        foreach ($container->findTaggedServiceIds('header.provider') as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('priority', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'priority');
                }
                $definition->addMethodCall('addProvider', [$attributes['priority'], new Reference($id)]);
            }
        }
    }
}