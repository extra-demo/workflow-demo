<?php


namespace App\Workflow;


class TiAnWorkflow
{
    const NAME = 'ti_an';

    const S_CREATED = '已创建';
    const S_X_UPLOADED = '提案已上传';
    const S_X_SUBMITTED = '提案已提交给客户'; // 已提交给客户
    const S_X_FAILED = '提案失败'; // 提案失败
    const S_X_CONFIRMED = '已确认'; // 提案失败
    const S_X_CLOSED = '已关闭'; // 提案失败

    const A_X_UPLOAD = '上传提案';
    const A_X_REJECT = '提案审核未通过';
    const A_X_SUBMIT = '提交给客户';
    const A_X_CUSTOMER_CONFIRM = '客户确认';
    const A_X_CUSTOMER_REJECT = '客户拒绝';
    const A_X_ADMIN_CONFIRM = '管理员代确认';
    const A_CLOSE = '关闭';
}
