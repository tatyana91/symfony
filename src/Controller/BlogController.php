<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController
{
    /**
     * @Route("/blog_annotation/{page}", name="blog_list_annotation", requirements={"page"="\d+"})
     */
    public function list_annotation($page = 1)
    {
        return new Response(
            "Статья №$page (маршрут через аннотацию)"
        );
    }

    public function list_yaml($page = 1)
    {
        return new Response(
            "Статья №$page (маршрут через yaml)"
        );
    }

    public function list_xml($page = 1)
    {
        return new Response(
            "Статья №$page (маршрут через xml)"
        );
    }

    public function list_php($page = 1)
    {
        return new Response(
            "Статья №$page (маршрут через php)"
        );
    }

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

}
