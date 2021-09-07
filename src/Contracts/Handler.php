<?php

namespace Bigmom\Health\Contracts;

use Exception;

interface Handler
{
    public function handleSuccess(): void;

    public function handleException(Exception $e): void;
} 
