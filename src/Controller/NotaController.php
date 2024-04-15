<?php

namespace App\Controller;

use App\Entity\Nota;
use App\Service\NotaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NotaController extends AbstractController
{
    private $notaService;

    public function __construct(NotaService $notaService) {
        $this->notaService = $notaService;
    }
    #[Route('/nota', name: 'app_nota_new')]
    public function crearNota(EntityManagerInterface $entityManager)
    {
        $nota = new Nota();
        $nota->setTitulo('Nota creada en el apartado B');
        $nota->setDescripcion('Guardada en la base de datos a través de NotaService');

        $this->notaService->crearNota($nota);

        return $this->render('nota/index.html.twig', [
            'controller_name' => 'NotaController',
            'nota_id' => $nota->getId(),
            'titulo'=> $nota->getTitulo(),
            'descripcion' => $nota->getDescripcion()
        ]);
    }

    #[Route('/nota/tabla', name: 'app_nota_tabla')]
    public function mostrarNotas()
    {
        $notas = $this->notaService->getAllNotas();

        return $this->render('nota/notas.html.twig', [
            'controller_name' => 'NotaController',
            'notas' => $notas
        ]);
    }
}
