<?php

namespace App;

class GoalStrategy
{
    public function support(string $type): bool
    {
        return $type === 'goal';
    }

    public function validateData(array $data): void
    {
        if (!isset($data['match_id']) || !isset($data['team_id'])) {
            throw new \InvalidArgumentException('match_id and team_id are required for goal events');
        }
    }

    public function getType(): string
    {
        return 'goals';
    }
}

