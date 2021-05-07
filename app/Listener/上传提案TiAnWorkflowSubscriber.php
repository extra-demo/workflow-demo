<?php


namespace App\Listener;


use Illuminate\Events\Dispatcher;
use Symfony\Component\Workflow\TransitionBlocker;
use ZeroDaHero\LaravelWorkflow\Events\CompletedEvent;
use ZeroDaHero\LaravelWorkflow\Events\GuardEvent;

class 上传提案TiAnWorkflowSubscriber extends TiAnWorkflowSubscriber
{
    /**
     * @param GuardEvent $event
     * @throws \Exception
     */
    public function onGuard(GuardEvent $event)
    {
        $subject = $event->getSubject();
        if (!$subject->uploaded) {
            $event->addTransitionBlocker(new TransitionBlocker('提案需要上传', 0, ['bob' => 'hello']));
            $event->setBlocked(true);
        }
    }

    public function onAfter(CompletedEvent $event)
    {
        \Log::info("已经上传提案，请及时审核");
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            $this->guard('ti_an', '上传提案'),
            $this->callable('onGuard')
        );
        $events->listen(
            $this->after('ti_an', '上传提案'),
            $this->callable('onAfter')
        );
    }
}
