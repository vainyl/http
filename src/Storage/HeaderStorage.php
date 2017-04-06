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

namespace Vainyl\Http\Storage;

use Vainyl\Core\Storage\Proxy\AbstractStorageProxy;

/**
 * Class HeaderStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HeaderStorage extends AbstractStorageProxy
{
    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return parent::offsetExists(strtolower($offset));
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return parent::offsetGet(strtolower($offset));
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        parent::offsetSet(strtolower($offset), $value);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        parent::offsetUnset(strtolower($offset));
    }
}