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
declare(strict_types = 1);

namespace Vainyl\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Class SapiEmitter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SapiEmitter implements EmitterInterface
{
    /**
     * @return EmitterInterface
     */
    protected function closeBuffers(): EmitterInterface
    {
        $obStatuses = ob_get_status(true);
        $level = count($obStatuses);
        $flags = PHP_OUTPUT_HANDLER_REMOVABLE | PHP_OUTPUT_HANDLER_FLUSHABLE;
        while ($level-- > 0 && ($status = $obStatuses[$level])
               && (isset($status['del'])
                ? $status['del']
                : !isset($status['flags']) || $flags === ($status['flags'] & $flags))) {
            ob_end_flush();
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function send(ResponseInterface $response): EmitterInterface
    {
        if (headers_sent()) {
            return $this;
        }
        header(
            sprintf(
                'HTTP/%s %s %s',
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                $response->getReasonPhrase()
            ),
            true,
            $response->getStatusCode()
        );
        foreach ($response->getHeaders() as $header => $values) {
            $first = true;
            foreach ($values as $value) {
                header(sprintf('%s: %s', $header, $value), $first);
                $first = false;
            }
        }
        echo $response->getBody();
        switch (true) {
            case function_exists('fastcgi_finish_request'):
                fastcgi_finish_request();
                break;
            case 'cli' !== PHP_SAPI:
                $this->closeBuffers();
                break;
        }

        return $this;
    }
}