<?php

use App\Workflow\TiAnWorkflow;

return [
    'ti_an' => [
        'type' => 'workflow',
        'marking_store' => [
            'type' => 'single_state',
        ],
        'supports' => [\App\Models\TiAn::class],
        'places' => [
            TiAnWorkflow::S_CREATED,
            TiAnWorkflow::S_X_UPLOADED,
            TiAnWorkflow::S_X_SUBMITTED,
            TiAnWorkflow::S_X_FAILED,
            TiAnWorkflow::S_X_CONFIRMED,
            TiAnWorkflow::S_X_CLOSED,
        ],
        'transitions' => [
            TiAnWorkflow::A_X_UPLOAD => [
                'from' => TiAnWorkflow::S_CREATED,
                'to' => TiAnWorkflow::S_X_UPLOADED,
            ],
            TiAnWorkflow::A_X_REJECT => [
                'from' => TiAnWorkflow::S_X_UPLOADED,
                'to' => TiAnWorkflow::S_CREATED,
            ],
            TiAnWorkflow::A_X_SUBMIT => [
                'from' => TiAnWorkflow::S_X_UPLOADED,
                'to' => TiAnWorkflow::S_X_SUBMITTED,
            ],
            TiAnWorkflow::A_X_CUSTOMER_CONFIRM => [
                'from' => TiAnWorkflow::S_X_SUBMITTED,
                'to' => TiAnWorkflow::S_X_CONFIRMED,
            ],
            TiAnWorkflow::A_X_CUSTOMER_REJECT => [
                'from' => TiAnWorkflow::S_X_SUBMITTED,
                'to' => TiAnWorkflow::S_X_FAILED,
            ],
            TiAnWorkflow::A_X_ADMIN_CONFIRM => [
                'from' => TiAnWorkflow::S_X_SUBMITTED,
                'to' => TiAnWorkflow::S_X_CONFIRMED,
            ],
            TiAnWorkflow::A_CLOSE => [
                'from' => [
                    TiAnWorkflow::S_CREATED,
                    TiAnWorkflow::S_X_UPLOADED,
                ],
                'to' => TiAnWorkflow::S_X_CLOSED,
            ]
        ],
        'initial_places' => [TiAnWorkflow::S_CREATED],
        'events_to_dispatch' => [
//            Symfony\Component\Workflow\WorkflowEvents::ENTER,
//            Symfony\Component\Workflow\WorkflowEvents::LEAVE,
//            Symfony\Component\Workflow\WorkflowEvents::TRANSITION,
//            Symfony\Component\Workflow\WorkflowEvents::ENTERED,
//            Symfony\Component\Workflow\WorkflowEvents::COMPLETED,
//            Symfony\Component\Workflow\WorkflowEvents::ANNOUNCE,
        ],
    ],
];
