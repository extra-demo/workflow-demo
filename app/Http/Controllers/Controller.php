<?php

namespace App\Http\Controllers;

use App\Models\TiAn;
use App\Workflow\TiAnWorkflow;
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

    const WORKFLOW_NAME = TiAnWorkflow::NAME;

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

    public function reset(Request $request)
    {
        $id = $request->get('id');
        $m = TiAn::query()->find($id);
        $m->marking = null;
        $m->uploaded = false;
        $m->remark = null;
        $m->save();

        return redirect('/show?id=' . $id);
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) {
            return redirect('/show?id=1');
        }

        $m = TiAn::query()->find($id);

        $v = $this->workflowRegistry->get($m, TiAnWorkflow::NAME);


        return view('workflow', [
            'workflow' => $v,
            'm' => $m,
        ]);
    }

    public function img(Request $request)
    {
        $workflowName = $request->get('workflow');
        $id = $request->get('id', 1);

        if (!$workflowName) {
            return redirect(sprintf("/img?workflow=%s&id=%s", static::WORKFLOW_NAME, $id));
        }

        $subject = TiAn::query()->find($id);
        $workflow = $this->workflowRegistry->get($subject, $workflowName);
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

        $action = TiAnWorkflow::A_X_UPLOAD;
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

        $action = TiAnWorkflow::A_CLOSE;
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

        $action = TiAnWorkflow::A_X_REJECT;
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

        $action = TiAnWorkflow::A_X_SUBMIT;
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

        $action = TiAnWorkflow::A_X_CUSTOMER_CONFIRM;
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

        $action = TiAnWorkflow::A_X_ADMIN_CONFIRM;
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

        $action = TiAnWorkflow::A_X_CUSTOMER_REJECT;
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

    public function showFlow(Request $request)
    {
        $workflowName = $request->get('workflow');

        if (!$workflowName) {
            return redirect('/show-flow?workflow=' . static::WORKFLOW_NAME);
        }

        return view('flow-show');
    }
}
