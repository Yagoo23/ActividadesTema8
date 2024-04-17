<?php

namespace App\Controller;

use App\Entity\Nota;
use App\Service\NotaService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotaController extends AbstractController
{

    public function __construct(private NotaService $notaService)
    {
    }

    // #[Route('/nota/new', name: 'app_nota_new')]
    // public function crearNota(): Response
    // {
    //     $nota = new Nota();
    //     $nota->setTitulo('Nota nueva');
    //     $nota->setDescripcion('Probando el enlace');

    //     $this->notaService->crearNota($nota);

    //     return $this->render('nota/index.html.twig', [
    //         'controller_name' => 'NotaController',
    //         'nota' => $nota
    //     ]);
    // }

    #[Route('/nota/new', name: 'app_nota_new')]
    public function new(Request $request, NotaService $notaService, ValidatorInterface $validator): Response
    {
        $nota = new Nota();

        if ($request->getMethod() === 'POST') {
            $titulo = $request->request->get('titulo');
            $desc = $request->request->get('desc');

            $nota->setTitulo($titulo);
            $nota->setDescripcion($desc);

            $errores = $validator->validate($nota);

            if (count($errores) > 0) {
                foreach ($errores as $error) {
                    $this->addFlash('danger', 'Se ha producido un error. ' . $error->getMessage());
                }
            } else {
                $notaService->crearNota($nota);
                $this->addFlash('success', 'Nota creada correctamente.');

                return $this->redirectToRoute('app_nota_tabla');
            }
        }
        return $this->render('nota/crear.html.twig', [
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

    #[Route('/nota/{id}', name: 'app_nota_nota')]
    public function show(Nota $nota): Response
    {
        $this->addFlash('success', 'Hemos encontrado la nota.');

        return $this->render('nota/detail.html.twig', [
            'controller_name' => 'NotaController',
            'nota' => $nota
        ]);
    }
}
