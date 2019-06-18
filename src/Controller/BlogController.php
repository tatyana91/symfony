<?php
namespace App\Controller;

use App\Service\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog_annotation/{page}", name="blog_annotation", requirements={"page"="\d+"})
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
     * @Route("/blog/{page}", name="blog_show", requirements={"page"="\d+"})
     */
    public function show(SomeService $service, Request $request, SessionInterface $session){
        /*http://mysite/blog/35?name=test*/
        $get_name = $request->query->get('name');
        $post_name = $request->request->get('name');
        $method = $request->getMethod();
        $url = $service->someMethod();

        $session->set('email', 'test@test.com');
        $session_email = $session->get('email');

        $this->addFlash('notice', 'флеш успешно добавлен');
        //return $this->redirectToRoute('app_catalog_show');
        return $this->redirect('/catalog/show');

        return new Response(
            "url = $url,<br>
                            method = $method,<br>
                            get_name = $get_name,<br>
                            post_name = $post_name,<br>
                            session_email = $session_email"
        );
    }
}
