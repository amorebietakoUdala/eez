<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126075053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expedient ADD modified_by_id INT DEFAULT NULL, DROP modified_by');
        $this->addSql('ALTER TABLE expedient ADD CONSTRAINT FK_F38F876199049ECE FOREIGN KEY (modified_by_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_F38F876199049ECE ON expedient (modified_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE expedient DROP FOREIGN KEY FK_F38F876199049ECE');
        $this->addSql('DROP INDEX IDX_F38F876199049ECE ON expedient');
        $this->addSql('ALTER TABLE expedient ADD modified_by VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP modified_by_id');
    }
}
