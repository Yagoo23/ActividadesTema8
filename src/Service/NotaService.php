<?php

namespace App\Service;

use App\Entity\Nota;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NotaRepository;

class NotaService
{
    public function __construct(private EntityManagerInterface $entityManager,private NotaRepository $notaRepository)
    {
        
    }

    public function crearNota(Nota $nota)
    {
        $this->entityManager->persist($nota);
        $this->entityManager->flush();
    }

    public function getAllNotas()
    {
        return $this->notaRepository->findAll();
    }

}
