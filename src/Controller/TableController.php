<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    #[Route('/table/{fila}/{columna}', name: 'app_table', requirements: ['fila' => '\d+', 'columna' => '\d+'])]
    public function index($filas = 4, $cols = 4): Response
    {
        // Generar el array bidimensional de números enteros aleatorios entre 0 y 100
        $arrayBidimensional = [];
        for ($i = 0; $i < $filas; $i++) {
            $fila = [];
            for ($j = 0; $j < $cols; $j++) {
                $fila[] = random_int(0, 100);
            }
            $arrayBidimensional[] = $fila;
        }

        // Renderizar la plantilla y pasar el array a la misma
        return $this->render('table/index.html.twig', [
            'controller_name' => 'TableController',
            'array_bidimensional' => $arrayBidimensional,
        ]);
    }
}
