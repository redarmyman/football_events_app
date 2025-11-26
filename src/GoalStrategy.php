<?php

namespace App;

class GoalStrategy extends BaseStrategy
{
    public function support(string $type): bool
    {
        return $type === 'goal';
    }

    public function validateData(array $data): void
    {
        parent::validateData($data);

        if (!isset($data['assisting_player'])) {
            throw new \InvalidArgumentException('assisiting_player is required for goal events');
        }
    }

    public function getType(): string
    {
        return 'goals';
    }
}

