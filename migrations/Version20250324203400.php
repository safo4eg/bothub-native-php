<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250324203400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create_users_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('users');

        $table->addColumn(name: 'id', typeName: 'bigint', options: [
            'unsigned' => true,
            'autoincrement' => true,
            'default' => 0
        ]);

        $table->setPrimaryKey(['id']);

        $table->addColumn(name: 'balance', typeName: 'bigint', options: [
            'unsigned' => true,
        ]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('users');
    }
}
