<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNoteTable extends AbstractMigration
{

    public function up(): void
    {
        $table = $this->table('tasks');
        $table->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('content', 'string', ['limit' => 1000])
            ->addColumn('status', 'string')
            ->create();
    }

    public function down()
    {
        $this->table('notes')->drop()->save();
    }
}
