<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class TableController extends AbstractController
{
    private const NUM = 4;
    private const NUM_MAX = 100;
    private const NUM_MIN = 0;

    #[Route('/table/{filas}/{columnas}', name: 'app_table', requirements: ['filas' => '(<[1-9]+\d*>)', 'columnas' => '(<[1-9]+\d*>)'])]
    public function index($filas=self::NUM,$columnas=self::NUM): Response
    {
        $arrayBidimensional = [];
        for ($i = 0; $i < $filas; $i++) {
            $fila = [];
            for ($j = 0; $j < $columnas; $j++) {
                $fila[] = random_int(self::NUM_MIN, self::NUM_MAX);
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
