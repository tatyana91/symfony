<?php
/**
 * Created by PhpStorm.
 * User: Tatyana
 * Date: 17.06.2019
 * Time: 16:57
 */

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController{
    /**
     * @Route(
     *     "/articles_annotation/{_locale}/{year}/{slug}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "ru|en|ua",
     *         "_format": "html|json|xml",
     *         "year": "\d+"
     *     }
     * )
     */
    public function show_annotation($_locale, $year, $slug)
    {
        return new Response(
            '<?xml version="1.0" encoding="utf-8"?> 
                            <note>
                                <heading>Расширенная настройка маршрутизации</heading>
                                <body>Маршрут через аннотацию</body>
                            </note>'
        );
    }

    public function show_yaml($_locale, $year, $slug)
    {
        return new Response(
            '<?xml version="1.0" encoding="utf-8"?> 
                            <note>
                                <heading>Расширенная настройка маршрутизации</heading>
                                <body>Маршрут через yaml</body>
                            </note>'
        );
    }

    public function show_xml($_locale, $year, $slug)
    {
        return new Response(
            '<?xml version="1.0" encoding="utf-8"?> 
                            <note>
                                <heading>Расширенная настройка маршрутизации</heading>
                                <body>Маршрут через xml</body>
                            </note>'
        );
    }

    public function show_php($_locale, $year, $slug)
    {
        return new Response(
            '<?xml version="1.0" encoding="utf-8"?> 
                            <note>
                                <heading>Расширенная настройка маршрутизации</heading>
                                <body>Маршрут через php</body>
                            </note>'
        );
    }
}