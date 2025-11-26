<?php

namespace App;

class FoulStrategy extends BaseStrategy
{
    public function support(string $type): bool
    {
        return $type === 'foul';
    }

    public function validateData(array $data): void
    {
        parent::validateData($data);

        if (!isset($data['affected_player'])) {
            throw new \InvalidArgumentException('affected_player is required for foul events');
        }
    }

    public function getType(): string
    {
        return 'fouls';
    }
}

