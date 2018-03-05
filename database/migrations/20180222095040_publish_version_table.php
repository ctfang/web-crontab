<?php


use Universe\Migrate\AbstractMigration;

class PublishVersionTable extends AbstractMigration
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
        // 历史版本
        $users = $this->table('publish_versions');
        $users->addColumn('log_id', 'string', array('limit' => 100,'comment'=>'发布logId'))
            ->addColumn('author', 'string', array('limit' => 100,'comment'=>'发布人'))
            ->addColumn('sys_user', 'string', array('limit' => 20,'comment'=>'权限'))
            ->addColumn('run_time', 'string', array('limit' => 100,'comment'=>'运行规则'))
            ->addColumn('command', 'string', array('limit' => 100,'comment'=>'命令'))
            ->addTimestamps()
            ->save();
    }
}
