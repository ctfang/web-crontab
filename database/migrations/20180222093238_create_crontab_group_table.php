<?php


use Universe\Migrate\AbstractMigration;

class CreateCrontabGroupTable extends AbstractMigration
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
        $users = $this->table('crontab_groups');
        $users->addColumn('title', 'string', array('limit' => 100,'comment'=>'标题'))
            ->addColumn('remark', 'string', array('limit' => 200,'comment'=>'备注'))
            ->addColumn('type', 'integer', array('limit' => 1,'comment'=>'123'))
            ->addColumn('status', 'string', array('limit' => 1,'comment'=>'启用状态'))
            ->addColumn('author', 'string', array('limit' => 100,'comment'=>'作者'))
            ->addTimestamps()
            ->save();
    }
}
