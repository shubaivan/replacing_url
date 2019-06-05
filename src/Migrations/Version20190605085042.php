<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605085042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE hash_link ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hash_link ADD CONSTRAINT FK_897FCE41B03A8386 FOREIGN KEY (created_by_id) REFERENCES my_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_897FCE41B03A8386 ON hash_link (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hash_link DROP CONSTRAINT FK_897FCE41B03A8386');
        $this->addSql('DROP INDEX IDX_897FCE41B03A8386');
        $this->addSql('ALTER TABLE hash_link DROP created_by_id');
    }
}
