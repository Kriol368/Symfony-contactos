<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    private $contactos = [
        1 => ["nombre" => "Juan Pérez", "telefono" => "524142432", "email" => "juanp@ieselcaminas.org"],
        2 => ["nombre" => "Ana López", "telefono" => "58958448", "email" => "anita@ieselcaminas.org"],
        5 => ["nombre" => "Mario Montero", "telefono" => "5326824", "email" => "mario.mont@ieselcaminas.org"],
        7 => ["nombre" => "Laura Martínez", "telefono" => "42898966", "email" => "lm2000@ieselcaminas.org"],
        9 => ["nombre" => "Nora Jover", "telefono" => "54565859", "email" => "norajover@ieselcaminas.org"]
    ];


    /**
     * @Route("/contacto", name="inicio")
     */
    public function index(): Response
    {
        return $this->render('/contacto/inicio.html.twig', []);

    }
    /**
     * @Route("/contacto/{codigo}", name="ficha_contacto")
     */
    public function ficha($codigo): Response{
        //Si no existe el elemento con dicha clave devolvemos null
        $resultado = ($this->contactos[$codigo] ?? null);

        return $this->render('contacto/ficha_contacto.html.twig', [
            'contacto' => $resultado
        ]);
    }

    /**
     * @Route("/contacto/buscar/{texto}", name="buscar_contacto")
     */
    public function buscar ($texto): Response{
        //Filtramos aquellos que tengan dicho texto en el nombre
        $resultados = array_filter($this->contactos,function($contacto) use ($texto){
            return strpos($contacto['nombre'],$texto) !== FALSE;
        });
        return $this->render('contacto/lista_contactos.html.twig', ['contactos' => $resultados]);
    }
}
