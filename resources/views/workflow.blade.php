<?php
/** @var \Symfony\Component\Workflow\Workflow $workflow */
?>
<a href="/reset">reset</a><br>
<hr>
<div style="color:red;font-size: 20px">错误：@if(\Session::has('errors')) {{session('errors')->first('e')}} @endif</div>
<hr>
流程名称：{{$workflow->getName()}} <br>
当前状态：{{implode(', ', array_keys($workflow->getMarking($m)->getPlaces()))}}<br>
可用Trasition:
<ul>
    @foreach($workflow->getEnabledTransitions($m) as $item)
        <li>{{$item->getName()}}: {{implode(',',$item->getFroms())}} >>>> {{implode(',',$item->getTos())}}</li>
    @endforeach
</ul>

<hr>

{{--@foreach($workflow->getEnabledTransitions($m) as $item)--}}
{{--    <a href="?action={{$item->getName()}}">{{$item->getName()}}</a><br>--}}
{{--@endforeach--}}

@if($workflow->getMarking($m)->has('待激活'))
    <ul>
        <li><a href="/upload?has=1&id={{request('id')}}">上传提案</a></li>
        <li><a href="/upload?id={{request('id')}}">上传提案(状态未就绪)</a></li>
        <li><a href="/close?id={{request('id')}}">关闭</a></li>
    </ul>
@elseif($workflow->getMarking($m)->has('提案已上传'))
    <ul>
        <li><a href="/submit?id={{request('id')}}">提交给客户</a></li>
        <li><a href="/reject?id={{request('id')}}">未通过</a></li>
        <li><a href="/close?id={{request('id')}}">关闭</a></li>
    </ul>
@elseif($workflow->getMarking($m)->has('待确认'))
    <ul>
        <li><a href="/customerConfirm?id={{request('id')}}">客户确认</a></li>
        <li><a href="/customerReject?id={{request('id')}}">客户拒绝</a></li>
        <li><a href="/adminConfirm?id={{request('id')}}">管理员代确认</a></li>
    </ul>
@else
    流程已完结，不可操作
@endif

<hr>
<img src="/img/?id={{request('id')}}"/>
