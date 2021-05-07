<?php


namespace App\Listener;


use Illuminate\Events\Dispatcher;
use ZeroDaHero\LaravelWorkflow\Events\GuardEvent;

class All extends TiAnWorkflowSubscriber
{
    public function onGuard($event)
    {
        \Log::info("workflow event", [$event]);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'workflow.*',
            $this->callable('onGuard')
        );
    }
}
