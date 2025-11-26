<?php

namespace Tests;

use App\EventTypeStrategies;
use App\FoulStrategy;
use App\GoalStrategy;
use PHPUnit\Framework\TestCase;

class EventTypeStrategiesTest extends TestCase
{
    private EventTypeStrategies $strategies;

    protected function setUp(): void
    {
        $this->strategies = new EventTypeStrategies();
    }
    
    public function testChoosingGoalStrategy(): void
    {
        $strategy = $this->strategies->getStrategy('goal');

        $this->assertInstanceOf(GoalStrategy::class, $strategy);
    }

    public function testChoosingFoulStrategy(): void
    {   
        $strategy = $this->strategies->getStrategy('foul');
        
        $this->assertInstanceOf(FoulStrategy::class, $strategy);
    }
    
    public function testChoosingNonExistingStrategy(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Event dummy does not exist');
    
        $this->strategies->getStrategy('dummy');
    }
}

