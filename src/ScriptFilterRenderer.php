<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/klein0r/slim-alfred-renderer
 * @copyright Copyright (c) 2015-2016 Matthias Kleine
 * @license   https://github.com/klein0r/slim-alfred-renderer/blob/master/LICENSE.md (MIT License)
 */

namespace Slim\Views;

use Psr\Http\Message\ResponseInterface;

/**
 * Alfred Script Filter Renderer
 *
 * Render PHP view scripts into a PSR-7 Response object
 */
class ScriptFilterRenderer
{
    /**
     * SlimRenderer constructor.
     */
    public function __construct()
    {
    }

    /**
     * Render as xml
     *
     * @param ResponseInterface $response
     * @param array $data
     *
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, array $data = [])
    {
        if (!$data || !is_array($data)) {
            return false;
        }

        $items = new \SimpleXMLElement("<items></items>"); // Create new XML element

        foreach ($data as $b) {
            $c = $items->addChild('item');

            $c_keys = array_keys($b);
            foreach ($c_keys as $key) {
                if ($key == 'uid') {
                    $c->addAttribute('uid', $b[$key]);
                } elseif ($key == 'arg') {
                    $c->addAttribute('arg', $b[$key]);
                } else {
                    $c->addChild($key, $b[$key]);
                }
            }
        }

        $response = $response->withAddedHeader('Content-type', 'text/xml');
        $response->getBody()->write($items->asXML());

        return $response;
    }
}
