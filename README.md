# workflow 

- 主任务流程图
- 采购单流程图


----

https://symfony.com/doc/current/workflow.html#using-events

- entered === no transition
- leave === transition
- transition === transition
- enter === transition
- entered === transition
- completed === transition
- announce (那些transition有效)

----
限制

1. 上传提案，能够触发的前提是，已经上传了提案文件
2. 关闭操作，需要检查，有关闭原因
3. 客户拒绝，需要检查，有以及原因
4. 管理员代确认，需要检查权限，以及原因

------
状态机出现变化时

状态变更
1. 新增一个状态，需要注意可能会变成一个孤儿状态，如果没有 transition 配合
2. 移除一个状态，需要注意，状态机可能会出现分裂，
3. 修改一个状态， 名字变化了，会产生很严重的影响
   ```
        一般情况我们不会直接修改状态，而是通过增加状态和Transition来兼容旧流程
        例如，数据库存储的状态叫A，但是修改成了A1，这个时候，如果不做兼容处理的话，会导致状态机无法执行，因为A不在新的状态机里
        1. 增加A1之后，需要涉及到的T都增加 A1，这样是可以保证两种状态都可以正常执行，待A全部处理完成之后，就可以直接移除A
        2. 直接使用迁移脚本，A迁移为A1，这样就可以直接删除A了
    ```

Transition变更
1. 新增 Transition，只要状态机不中断，就不会影响
2. 移除 Transition, 只要状态机不中断，就不会影响
3. 修改 Transition， 只要状态机不中断，就不会影响
