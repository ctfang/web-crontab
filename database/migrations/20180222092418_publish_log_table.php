<?php


use Universe\Migrate\AbstractMigration;

class PublishLogTable extends AbstractMigration
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
        // 发布log
        $users = $this->table('publish_logs');
        $users->addColumn('title', 'string', array('limit' => 100,'comment'=>'发布标题'))
            ->addColumn('group_id', 'integer', array('limit' => 11,'comment'=>'项目id'))
            ->addColumn('status', 'string', array('limit' => 1,'comment'=>'回滚状态'))
            ->addColumn('author', 'string', array('limit' => 100,'comment'=>'发布作者'))
            ->addTimestamps()
            ->save();
    }
}
