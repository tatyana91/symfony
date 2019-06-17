<?php
/**
 * Created by PhpStorm.
 * User: Tatyana
 * Date: 17.06.2019
 * Time: 12:20
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller{
    /**
     * @Route("lucky/number")
     */
    public function number(){
        $number = random_int(0,100);
        return $this->render("lucky/number.html.twig", array(
            "number" => $number
        ));
    }
}