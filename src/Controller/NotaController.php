<?php

namespace App\Controller;

use App\Entity\Nota;
use App\Service\NotaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NotaController extends AbstractController
{
    private $notaService;

    public function __construct(NotaService $notaService) {
        $this->notaService = $notaService;
    }
    #[Route('/nota/new', name: 'app_nota_new')]
    public function crearNota(NotaService $notaService):Response
    {
        $nota = new Nota();
        $nota->setTitulo('Nota nueva');
        $nota->setDescripcion('Probando el enlace');

        $this->notaService->crearNota($nota);

        return $this->render('nota/index.html.twig', [
            'controller_name' => 'NotaController',
            'nota' => $nota
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
