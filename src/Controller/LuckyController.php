<?php
/**
 * Created by PhpStorm.
 * User: Tatyana
 * Date: 17.06.2019
 * Time: 12:20
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController {
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