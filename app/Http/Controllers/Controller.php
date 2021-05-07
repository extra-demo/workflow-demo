<?php

namespace App\Http\Controllers;

use App\Models\TiAn;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\Process\Process;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;
use Symfony\Component\Workflow\Exception\NotEnabledTransitionException;
use Symfony\Component\Workflow\Exception\UndefinedTransitionException;
use ZeroDaHero\LaravelWorkflow\WorkflowRegistry;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const WORKFLOW_NAME = 'ti_an';

    /**
     * @var WorkflowRegistry
     */
    protected $workflowRegistry;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->workflowRegistry = app('workflow');
    }

    public function reset()
    {
        $m = TiAn::query()->find(1);
        $m->marking = null;
        $m->uploaded = false;
        $m->remark = null;
        $m->save();

        return redirect('/show');
    }


    public function show(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) {
            return redirect('/show?id=1');
        }

        $m = TiAn::query()->find($id);

        $v = $this->workflowRegistry->get($m, 'ti_an');


        return view('workflow', [
            'workflow' => $v,
            'm' => $m,
        ]);
    }

    public function img(Request $request)
    {
        $subject = TiAn::query()->find($request->get('id'));
        $workflow = $this->workflowRegistry->get($subject, 'ti_an');
        $definition = $workflow->getDefinition();

        $dumper = new GraphvizDumper();

        $dotCommand = ['dot', "-Tpng", '-o', "ti_an.png"];

        $process = new Process($dotCommand);
        $process->setWorkingDirectory(public_path());
        $process->setInput($dumper->dump($definition, $workflow->getMarking($subject)));
        $process->mustRun();

        return redirect("/ti_an.png");
    }

    public function upload(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '上传提案';
        $error = '----';

        if (1 == $request->get('has')) {
            $m->uploaded = true;
        }


        try {
            $v->apply($m, $action);
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }

    public function close(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '关闭';
        $error = '';

        try {
            $v->apply($m, $action);
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }

    public function reject(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '未通过';
        $error = '';

        try {
            $v->apply($m, $action);
            $m->uploaded = false;
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }

    public function submit(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '提交给客户';
        $error = '';

        try {
            $v->apply($m, $action);
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }

    public function customerConfirm(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '客户确认';
        $error = '';

        try {
            $v->apply($m, $action);
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }

    public function adminConfirm(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '管理员代确认';
        $error = '';

        try {
            $v->apply($m, $action);
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }

    public function customerReject(Request $request)
    {
        $m = TiAn::query()->find($request->get('id', 1));

        $v = $this->workflowRegistry->get($m, static::WORKFLOW_NAME);

        $action = '客户拒绝';
        $error = '';

        try {
            $v->apply($m, $action);
            $m->save();
        } catch (NotEnabledTransitionException $enabledTransitionException) {
            $error = $enabledTransitionException->getTransitionBlockerList()->getIterator()[0]->getMessage();
        } catch (UndefinedTransitionException $transitionException) {
        }

        return back()->withErrors(['e' => $error]);
    }
}
