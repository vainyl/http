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
<<<<<<< HEAD
declare(strict_types=1);

namespace Vainyl\Http;

use Vainyl\Core\NameableInterface;
use Vainyl\Core\StringInterface;
=======
declare(strict_types = 1);

namespace Vainyl\Http;

use Vainyl\Core\Name\NameableInterface;
use Vainyl\Core\String\StringInterface;
>>>>>>> Moved and refactored Header classes

/**
 * Interface HeaderInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface HeaderInterface extends NameableInterface, StringInterface
{
    /**
     * @param string $name
     *
     * @return HeaderInterface
     */
<<<<<<< HEAD
    public function withName(string $name): HeaderInterface;
=======
    public function withName(string $name) : HeaderInterface;
>>>>>>> Moved and refactored Header classes

    /**
     * @param array $values
     *
     * @return HeaderInterface
     */
<<<<<<< HEAD
    public function withValues(array $values): HeaderInterface;
=======
    public function withValues(array $values) : HeaderInterface;
>>>>>>> Moved and refactored Header classes

    /**
     * @return array
     */
<<<<<<< HEAD
    public function getValues(): array;
=======
    public function getValues() : array;
>>>>>>> Moved and refactored Header classes

    /**
     * @param string $value
     *
     * @return HeaderInterface
     */
<<<<<<< HEAD
    public function withAddedValue($value): HeaderInterface;
=======
    public function withAddedValue($value) : HeaderInterface;
>>>>>>> Moved and refactored Header classes
}