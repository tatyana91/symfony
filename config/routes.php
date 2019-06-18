<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\BlogController;
use App\Controller\ArticleController;

$collection = new RouteCollection();
$collection->add('blog_php', new Route('/blog_php/{page}', array(
    '_controller' => [BlogController::class, 'list_php']
)));

$collection->add(
    'article_php',
    new Route('/article_php/{_locale}/{year}/{slug}.{_format}', array(
        '_controller' => [ArticleController::class, 'show_php'],
        '_format'     => 'html',
    ), array(
        '_locale' => 'en|ru',
        '_format' => 'html|xml|json',
        'year'    => '\d+',
    ))
);

return $collection;