<?php

namespace App\Validator;

use App\Repository\NotaRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotaTituloUnicoValidator extends ConstraintValidator
{

    public function __construct(private NotaRepository $notaRepository) {
            
    }

    public function validate($nota, Constraint $constraint)
    {
        $titulo = $nota->getTitulo();

        if (null === $titulo || '' === $titulo) {
            return;
        }
        $notaConIgualTitulo = $this->notaRepository->findOneBy(["titulo" => $titulo]);
        if ($notaConIgualTitulo != null && $nota->getId() != $notaConIgualTitulo->getId()) {
            $this->context->buildViolation($constraint->message)->setParameter('{{value}}', $titulo)->addViolation();
        }
    }
}

