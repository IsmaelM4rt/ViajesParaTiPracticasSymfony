<?php

namespace App\Controller;

use App\Entity\Proveedor;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProveedorController extends Controller
{
    /**
     * @Route("/", name="lista_proveedor")
     * @Method({"GET"})
     * Funcion principal que carga el index de proveedores
     */
    public function index()
    {
        //Cargamos todo el listado de proveedores
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();
        //renderizamos la vista con el listado de proveedores
        return $this->render('proveedores/index.html.twig', array('proveedores' => $proveedores));
    }


    /**
     * @Route("/proveedor/nuevo", name="nuevo_proveedor")
     * Method({"GET", "POST"})
     * Funcion para crear nuevos proveedores
     */
    public function nuevo(Request $request)
    {
        $proveedor = new Proveedor();
        //Creamos un form para crear nuevos proveedores
        $form = $this->createFormBuilder($proveedor)
            ->add('nombre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('mail', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('telefono', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Hotel' => 1,
                    'Pista' => 2,
                    'Complemento' => 3,
                ],
            ], array('attr' => array('class' => 'form-control')))
            ->add('activo', ChoiceType::class, [
                'choices'  => [
                    'Activo' => 1,
                    'Inactivo' => 0,
                ],
            ], array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Añadir', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);
        //Obtenemos los datos del form y si es correcto añadimos el proveedor a la base de datos
        if ($form->isSubmitted() && $form->isValid()) {
            $proveedor = $form->getData();
            $date = new DateTime('NOW');
            $proveedor->setcreado($date);
            $proveedor->seteditado(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proveedor);
            $entityManager->flush();

            return $this->redirectToRoute('lista_proveedor');
        }
        //Renderizamos la vista de crear proveedores
        return $this->render('proveedores/nuevo.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/proveedor/editar/{id}", name="editar_proveedor")
     * Method({"GET", "POST"})
     * Funcion para editar proveedores
     */
    public function editar(Request $request, $id)
    {
        $proveedor = new Proveedor();
        //Obtenemos el proveedor por id
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        //Creamos un form para editar proveedores
        $form = $this->createFormBuilder($proveedor)
            ->add('nombre', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('mail', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('telefono', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('tipo', ChoiceType::class, [
                'choices'  => [
                    'Hotel' => 1,
                    'Pista' => 2,
                    'Complemento' => 3,
                ],
            ], array('attr' => array('class' => 'form-control')))
            ->add('activo', ChoiceType::class, [
                'choices'  => [
                    'Activo' => 1,
                    'Inactivo' => 0,
                ],
            ], array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);
        //Si el form es correcto guardamos los nuevos datos en la base de datos
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime('NOW');
            $proveedor->setcreado($proveedor->getcreado());
            $proveedor->seteditado($date);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('lista_proveedor');
        }
        //Renderizamos la vista para editar proveedores
        return $this->render('proveedores/editar.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/proveedor/{id}", name="mostrar_proveedor")
     * Funcion para mostrar detalles del proveedor
     */
    public function mostrar($id)
    {
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        //Renderizamos la vista para ver detalles del proveedor
        return $this->render('proveedores/mostrar.html.twig', array('proveedor' => $proveedor));
    }

    /**
     * @Route("/proveedor/borrar/{id}")
     * @Method({"DELETE"})
     * Funcnion para borrar el proveedor
     */
    public function borrar(Request $request, $id)
    {
        //Obtenemos el proveedor a borrar por id
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($proveedor);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}
