<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


trait ExceptionTrait
{
    public function apiException($request, $e)
    {
       
        if ($request->is('api/*')) {
            return response()->json([
                'errors' => 'Record not found.'
            ], Response::HTTP_NOT_FOUND);
        }
  
    }
}


?>