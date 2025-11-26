<?php

namespace App;

abstract class BaseStrategy
{
    abstract public function support(string $type): bool;

    abstract public function getType(): string;

    public function validateData(array $data): void
    {
        if (!isset($data['match_id']) || !isset($data['team_id'])) {
            throw new \InvalidArgumentException('match_id and team_id are required for ' . $data['type'] . ' events');
        }
    }
}

