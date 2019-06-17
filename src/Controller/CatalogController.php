<?php
/**
 * Created by PhpStorm.
 * User: Tatyana
 * Date: 17.06.2019
 * Time: 12:20
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller{
    public function show(){
        return $this->render("catalog/show.html.twig", array(
            "title" => 'Каталог'
        ));
    }
}