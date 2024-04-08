<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

const NUM = 4;

class TableController extends AbstractController
{
    #[Route('/table/{filas}/{columnas}', name: 'app_table', requirements: ['filas' => '\d+', 'columnas' => '\d+'])]
    public function index($filas=NUM,$columnas=NUM): Response
    {
        $arrayBidimensional = [];
        for ($i = 0; $i < $filas; $i++) {
            $fila = [];
            for ($j = 0; $j < $columnas; $j++) {
                $fila[] = random_int(0, 100);
            }
            $arrayBidimensional[] = $fila;
        }

        // Renderizar la plantilla y pasar el array a la misma
        return $this->render('table/index.html.twig', [
            'controller_name' => 'TableController',
            'arrayBidimensional' => $arrayBidimensional
        ]);
    }
}
