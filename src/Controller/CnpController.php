<?php

namespace App\Controller;

use App\Exception\CnpValidationException;
use App\Service\CnpValidatorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CnpController
{
    private CnpValidatorService $cnpValidatorService;

    public function __construct(CnpValidatorService $cnpValidatorService)
    {
        $this->cnpValidatorService = $cnpValidatorService;
    }

    #[Route('/validate-cnp', methods: ['POST'])]
    public function validateCnp(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $cnp = $data['cnp'] ?? '';

        try {
            $isCnpValid = $this->cnpValidatorService->isCnpValid($cnp);

            return $isCnpValid ?
                new JsonResponse(['message' => 'The provided CNP is valid'], Response::HTTP_OK) :
                new JsonResponse(['message' => 'The provided CNP is valid'], Response::HTTP_BAD_REQUEST);
        } catch (CnpValidationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
