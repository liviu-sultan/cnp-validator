<?php

namespace App\Controller;

use App\Exception\CnpValidationException;
use App\Service\ValidationManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CnpController
{
    private ValidationManager $validationManager;

    public function __construct(ValidationManager $validationManager)
    {
        $this->validationManager = $validationManager;
    }

    #[Route('/validate-cnp', methods: ['POST'])]
    public function validateCnp(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $cnp = $data['cnp'] ?? '';

        try {
            $this->validationManager->isCnpValid($cnp);
            return new JsonResponse(['message' => 'CNP is valid.']);
        } catch (CnpValidationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
