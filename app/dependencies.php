<?php

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader((__DIR__) . '/views', [
            'extension' => '.html',
        ]),
    ],
]);

$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem((__DIR__) . '/views');
    $twig = new Twig_Environment($loader);
    return $twig;
});

$injector->alias('Aframe\Template\Renderer', 'Aframe\Template\TwigRenderer');
$injector->alias('Aframe\Template\FrontendRenderer', 'Aframe\Template\FrontendTwigRenderer');

$injector->define('Aframe\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/views',
]);

$injector->alias('Aframe\Page\PageReader', 'Aframe\Page\FilePageReader');
$injector->share('Aframe\Page\FilePageReader');

$injector->alias('Aframe\Menu\MenuReader', 'Aframe\Menu\ArrayMenuReader');
$injector->share('Aframe\Menu\FileMenuReader');

return $injector;
