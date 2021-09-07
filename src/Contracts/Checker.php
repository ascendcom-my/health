<?php

namespace Bigmom\Health\Contracts;

interface Checker
{
    public function handle(): void;

    public function runHealthCheck(): void;

    public function getName(): string;
} 
