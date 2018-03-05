<?php


use Universe\Migrate\AbstractMigration;

class CreateCrontabGroupEnvTable extends AbstractMigration
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
        $users = $this->table('crontab_group_env');
        $users->addColumn('group_id', 'integer', array('limit' => 11,'comment'=>'项目id'))
            ->addColumn('env_id', 'integer', array('limit' => 11,'comment'=>'环境id'))
            ->save();
    }
}
