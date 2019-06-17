<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\BlogController;

$collection = new RouteCollection();
$collection->add('blog_php', new Route('/blog_php/{page}', array(
    '_controller' => [BlogController::class, 'list_php']
)));

return $collection;