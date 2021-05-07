<?php


namespace App\Listener;


use Illuminate\Events\Dispatcher;
use ZeroDaHero\LaravelWorkflow\Events\CompletedEvent;
use ZeroDaHero\LaravelWorkflow\Events\EnterEvent;
use ZeroDaHero\LaravelWorkflow\Events\GuardEvent;

abstract class TiAnWorkflowSubscriber
{
    /**
     * @see GuardEvent
     * @param string $workflow
     * @param string $transition
     * @return string
     */
    protected function guard(string $workflow, string $transition): string
    {
        return "workflow.$workflow.guard.{$transition}";
    }

    /**
     * @see EnterEvent
     *
     * @param string $workflow
     * @param string $transition
     * @return string
     */
    protected function before(string $workflow, string $transition): string
    {
        return "workflow.$workflow.enter.{$transition}";
    }

    /**
     * @see CompletedEvent
     * @param string $workflow
     * @param string $transition
     * @return string
     */
    protected function after(string $workflow, string $transition): string
    {
        return "workflow.$workflow.completed.{$transition}";
    }

    abstract function subscribe(Dispatcher $events);

    protected function callable(string $func): string
    {
        return static::class . '@' . $func;
    }

}
