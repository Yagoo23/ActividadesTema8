<?php

namespace App\Service;

use App\Entity\Nota;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NotaRepository;

class NotaService
{
    private $entityManager;
    private $notaRepository;

    public function __construct(EntityManagerInterface $entityManager,NotaRepository $notaRepository)
    {
        $this->entityManager = $entityManager;
        $this->notaRepository = $notaRepository;
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
