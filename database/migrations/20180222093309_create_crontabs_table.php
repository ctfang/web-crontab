<?php


use Universe\Migrate\AbstractMigration;

class CreateCrontabsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // 命令
        $users = $this->table('crontabs');
        $users->addColumn('group_id', 'integer', array('limit' => 11,'comment'=>'组id'))
            ->addColumn('title', 'string', array('limit' => 100,'comment'=>'标题'))
            ->addColumn('sys_user', 'string', array('limit' => 20,'comment'=>'权限'))
            ->addColumn('status', 'string', array('limit' => 1,'comment'=>'启用状态'))
            ->addColumn('author', 'string', array('limit' => 100,'comment'=>'作者'))
            ->addColumn('run_time', 'string', array('limit' => 100,'comment'=>'运行规则'))
            ->addColumn('command', 'string', array('limit' => 100,'comment'=>'命令'))
            ->addTimestamps()
            ->save();
    }
}
