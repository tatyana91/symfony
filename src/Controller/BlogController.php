<?php
namespace App\Controller;

use App\Service\SomeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Translator;

use App\Entity\Task;
use App\Entity\House;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Contracts\Translation\TranslatorInterface;

use Doctrine\DBAL\Driver\Connection;

use Doctrine\ORM\EntityManagerInterface;

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
        //return $this->redirect('/catalog/show');

        return new Response(
            "url = $url,<br>
                            method = $method,<br>
                            get_name = $get_name,<br>
                            post_name = $post_name,<br>
                            session_email = $session_email"
        );
    }

    /**
     * @Route("/task/add", name="task_add")
     *
     * @param Request $request
     * @return Response
     */
    public function task_add(Request $request,
                                            TranslatorInterface $translator,
                                            Connection $conn){
        $task = new Task();
        $task->setTask($translator->trans('Write a blog post'));
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class, array('label' => 'Описание задачи: '))
            ->add('dueDate', DateType::class, array(
                'label' => 'Дата выполнения:',
                'choice_translation_domain' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Создать задачу'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            //db ...
            //var_dump("<pre>", $task, "</pre>");
            //return $this->redirectToRoute('app_catalog_show');
        }

        $entity_manager = $this->getDoctrine()->getManager();
        $conn = $entity_manager->getConnection();
        $sql = 'SELECT * FROM users';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users_mysitedb = $stmt->fetchAll();

        $entity_manager2 = $this->getDoctrine()->getManager('customer');
        $conn2 = $entity_manager2->getConnection();
        $sql = 'SELECT * FROM users';
        $stmt = $conn2->prepare($sql);
        $stmt->execute();
        $users_mysitedb2 = $stmt->fetchAll();

        return $this->render('blog/task.html.twig', array(
            'form' => $form->createView(),
            'users_mysitedb' => $users_mysitedb,
            'users_mysitedb2' => $users_mysitedb2,
        ));
    }

    /**
     * @Route("/task/insert", name="task_insert")
     *
     * @return Response
     */
    public function task_insert(){
        $entity_manager = $this->getDoctrine()->getManager();

        $house = new House();

        $house->setSquare(100);
        $house->setAddress('Воронцовская');

        $entity_manager->persist($house);

        $entity_manager->flush();

        return new Response("Дом сохранен с id = ".$house->getId());
    }

    /**
     * @Route("/task/show/{id}", name="task_show")
     *
     * @return Response
     */
    public function task_show($id = 1){
        $house = $this
            ->getDoctrine()
            ->getRepository(House::class)
            ->find($id);

        return new Response($house->getAddress());
    }

    /**
     * @Route("/task/all", name="task_all")
     *
     * @return Response
     */
    public function task_all(){
        $repository = $this
            ->getDoctrine()
            ->getRepository(House::class);

        $houses = $repository->createQueryBuilder('house')
            ->where('house.address LIKE :address')
            ->setParameter('address', 'Ворон%')
            ->getQuery()
            ->getResult();

        $houses = var_export($houses);

        return new Response($houses);
    }

    /**
     * @Route("/task/update/{id}", name="task_update")
     *
     * @return Response
     */
    public function task_update($id){
        $entity_manager = $this->getDoctrine()->getManager();

        $house = $entity_manager
            ->getRepository(House::class)
            ->find($id);

        if (!$house) {
            throw $this->createNotFoundException('Такого дома нет');
        }

        $house->setSquare(120);
        $house->setAddress('Воронцовская 35');

        $entity_manager->flush();

        return new Response("Изменения дома с id = ".$house->getId()." прошло успешно.");
    }

    /**
     * @Route("/task/delete/{id}", name="task_delete")
     *
     * @return Response
     */
    public function task_delete($id){
        $entity_manager = $this->getDoctrine()->getManager();

        $house = $entity_manager
            ->getRepository(House::class)
            ->find($id);

        if (!$house) {
            throw $this->createNotFoundException('Такого дома нет');
        }

        $entity_manager->remove($house);
        $entity_manager->flush();

        return new Response("Дом с id = $id успешно удален.");
    }
}
