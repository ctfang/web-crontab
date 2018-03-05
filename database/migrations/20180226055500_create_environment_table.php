<?php


use Universe\Migrate\AbstractMigration;

class CreateEnvironmentTable extends AbstractMigration
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
        $users = $this->table('environment');
        $users->addColumn('title', 'string', array('limit' => 20,'comment'=>'标题'))
            ->addColumn('type', 'string', array('limit' => 20,'comment'=>'环境类型'))
            ->addColumn('host', 'string', array('limit' => 20,'comment'=>'地址'))
            ->addColumn('username', 'string', array('limit' => 20,'comment'=>'登录账号'))
            ->addColumn('password', 'string', array('limit' => 64,'comment'=>'登录密码'))
            ->addColumn('remark', 'string', array('limit' => 100,'comment'=>'备注'))
            ->addTimestamps()
            ->save();
    }
}
