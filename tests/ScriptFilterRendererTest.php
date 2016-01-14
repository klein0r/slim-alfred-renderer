<?php

use Slim\Http\Body;
use Slim\Http\Headers;
use Slim\Http\Response;

/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/klein0r/slim-alfred-renderer
 * @copyright Copyright (c) 2015-2016 Matthias Kleine
 * @license   https://github.com/klein0r/slim-alfred-renderer/blob/master/LICENSE.md (MIT License)
 */
class ScriptFilterRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testRenderer() {
        $renderer = new \Slim\Views\ScriptFilterRenderer();

        $headers = new Headers();
        $body = new Body(fopen('php://temp', 'r+'));
        $response = new Response(200, $headers, $body);

        $newResponse = $renderer->render(
            $response,
            [
                [
                    'uid' => '35345345u2938475h',
                    'arg' => 'argument1',
                    'title' => 'thetitle',
                    'subtitle' => 'thesubtitle',
                    'icon' => 'icon.png',
                    'valid' => 'yes'
                ]
            ]
        );

        $newResponse->getBody()->rewind();

        $this->assertEquals(
            '<?xml version="1.0"?>' . PHP_EOL .'<items><item uid="35345345u2938475h" arg="argument1"><title>thetitle</title><subtitle>thesubtitle</subtitle><icon>icon.png</icon><valid>yes</valid></item></items>' . PHP_EOL,
            $newResponse->getBody()->getContents()
        );
    }
}
