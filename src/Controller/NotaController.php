<?php

namespace App\Controller;

use App\Entity\Nota;
use App\Service\NotaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NotaController extends AbstractController
{

    public function __construct(private NotaService $notaService) {
        
    }

    #[Route('/nota/new', name: 'app_nota_new')]
    public function crearNota ():Response
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

    #[Route('/nota', name: 'app_nota_tabla')]
    public function mostrarNotas()
    {
        $notas = $this->notaService->getAllNotas();

        return $this->render('nota/notas.html.twig', [
            'controller_name' => 'NotaController',
            'notas' => $notas
        ]);
    }
}
