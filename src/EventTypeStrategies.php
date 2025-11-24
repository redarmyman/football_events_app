<?php

namespace App;

class EventTypeStrategies
{
    private array $strategies;

    public function __construct() {
        $this->strategies = [new FoulStrategy(), new GoalStrategy()];
    }

    public function getStrategy(string $type)
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->support($type)) {
                return $strategy;
            }
        }

        throw new \InvalidArgumentException('Event ' . $type . ' does not exist');
    }   
}

