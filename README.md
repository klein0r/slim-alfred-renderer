## PHP Renderer

This is a renderer for rendering [Alfred 2](https://www.alfredapp.com/) XML into a PSR-7 Response object. It works well with Slim Framework 3.

## Installation

Install with [Composer](http://getcomposer.org):

    composer require klein0r/slim-alfred-renderer

## Usage With Slim 3

```php
use Slim\Views\ScriptFilterRenderer;

include "vendor/autoload.php";

$app = new Slim\App();
$container = $app->getContainer();
$container['alfredRenderer'] = new ScriptFilterRenderer();

$app->get('/hello/{name}', function ($request, $response, $args) {

    $data = [
        [
            'uid' => '35345345u2938475h',
            'arg' => 'argument1',
            'title' => 'thetitle',
            'subtitle' => 'thesubtitle',
            'icon' => 'icon.png',
            'valid' => 'yes'
        ]
    ];

    return $this->alfredRenderer->render($response, $data);
});

$app->run();
```

## Exceptions
`\RuntimeException` - if template does not exist

`\InvalidArgumentException` - if $data contains 'template'
