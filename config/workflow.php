<?php

return [
    'straight' => [
        'type' => 'state_machine',
        'marking_store' => [
            'type' => 'single_state',
        ],
        'supports' => ['stdClass'],
        'places' => ['a', 'b', 'c'],
        'transitions' => [
            't1' => [
                'from' => 'a',
                'to' => 'b',
            ],
            't2' => [
                'from' => 'b',
                'to' => 'c',
            ],
        ],
    ],
    'ti_an' => [
        'type' => 'workflow',
        'marking_store' => [
            'type' => 'single_state',
        ],
        'supports' => [\App\Models\TiAn::class],
        'places' => [
            '待激活', // 待激活

//            'd_t_a', // 待提案
            '提案已上传', // 提案已上传

            '待确认', // 待确认

            '提案失败', // 提案失败
            '已确认', // 已确认
            '已关闭', // 已关闭
        ],
        'transitions' => [
            '上传提案' => [
                'from' => '待激活',
                'to' => '提案已上传',
            ],
            '未通过' => [
                'from' => '提案已上传',
                'to' => '待激活',
            ],
            '提交给客户' => [
                'from' => '提案已上传',
                'to' => '待确认',
            ],
            '客户确认' => [
                'from' => '待确认',
                'to' => '已确认',
            ],
            '客户拒绝' => [
                'from' => '待确认',
                'to' => '提案失败',
            ],
            '管理员代确认' => [
                'from' => '待确认',
                'to' => '已确认',
            ],
            '关闭' => [
                'from' => [
                    '待激活',
                    '提案已上传'
                ],
                'to' => '已关闭'
            ]
        ],
        'initial_places' => ['待激活'],
        'events_to_dispatch' => [
//            Symfony\Component\Workflow\WorkflowEvents::ENTER,
//            Symfony\Component\Workflow\WorkflowEvents::LEAVE,
//            Symfony\Component\Workflow\WorkflowEvents::TRANSITION,
//            Symfony\Component\Workflow\WorkflowEvents::ENTERED,
//            Symfony\Component\Workflow\WorkflowEvents::COMPLETED,
//            Symfony\Component\Workflow\WorkflowEvents::ANNOUNCE,
        ],
    ],
    'music' => [
        'type' => 'workflow',
        'marking_store' => [
            'type' => 'single_state',
        ],
        'supports' => [\App\Models\TiAn::class],
        'places' => [
            'stop',
            'playing',
            'pause'
        ],
        'transitions' => [
            'pause' => [
                'from' => 'playing',
                'to' => 'pause',
            ],
            'stop' => [
                'from' => 'playing',
                'to' => 'stop',
            ],
            'play' => [
                'from' => [
                    'stop',
                    'pause'
                ],
                'to' => 'playing'
            ]
        ],
        'initial_places' => ['stop'],
        'events_to_dispatch' => [],
    ],
];
