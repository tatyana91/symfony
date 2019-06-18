<?php
/**
 * Created by PhpStorm.
 * User: Tatyana
 * Date: 17.06.2019
 * Time: 17:32
 */
namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SomeService {
    private $router;

    public function __construct(UrlGeneratorInterface $router){
        $this->router = $router;
    }

    public function someMethod(){
        $url = $this->router->generate(
            'app_catalog_show',
                        [
                            'page' => 2,
                            'sort' => "desc"
                        ]
        );
        return $url;
    }
}
