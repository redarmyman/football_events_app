<?php

namespace App;

class FoulStrategy
{
    public function support(string $type): bool
    {
        return $type === 'foul';
    }

    public function validateData(array $data): void
    {
        if (!isset($data['match_id']) || !isset($data['team_id'])) {
            throw new \InvalidArgumentException('match_id and team_id are required for foul events');
        }
    }

    public function getType(): string
    {
        return 'fouls';
    }
}

