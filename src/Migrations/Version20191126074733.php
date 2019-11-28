<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126074733 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expedient ADD created_by_id INT DEFAULT NULL, DROP created_by');
        $this->addSql('ALTER TABLE expedient ADD CONSTRAINT FK_F38F8761B03A8386 FOREIGN KEY (created_by_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_F38F8761B03A8386 ON expedient (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expedient DROP FOREIGN KEY FK_F38F8761B03A8386');
        $this->addSql('DROP INDEX IDX_F38F8761B03A8386 ON expedient');
        $this->addSql('ALTER TABLE expedient ADD created_by VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP created_by_id');
    }
}
