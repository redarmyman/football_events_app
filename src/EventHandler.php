<?php

namespace App;

class EventHandler
{
    private FileStorage $storage;
    private StatisticsManager $statisticsManager;
    private EventTypeStrategies $strategies;
    
    public function __construct(string $storagePath, ?StatisticsManager $statisticsManager = null)
    {
        $this->storage = new FileStorage($storagePath);
        $this->statisticsManager = $statisticsManager ?? new StatisticsManager(__DIR__ . '/../storage/statistics.txt');
        $this->strategies = new EventTypeStrategies();
    }
    
    public function handleEvent(array $data): array
    {
        if (!isset($data['type'])) {
            throw new \InvalidArgumentException('Event type is required');
        }
        
        $event = [
            'type' => $data['type'],
            'timestamp' => time(),
            'data' => $data
        ];
        
        $this->storage->save($event);
        
        $strategy = $this->strategies->getStrategy($data['type']);
        $strategy->validateData($data);

        $this->statisticsManager->updateTeamStatistics(
            $data['match_id'],
            $data['team_id'],
            $strategy->getType()
        );
        
        return [
            'status' => 'success',
            'message' => 'Event saved successfully',
            'event' => $event
        ];
    }
}
