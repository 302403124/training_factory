<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116085316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE les ADD instructeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE les ADD CONSTRAINT FK_6F0A543225FCA809 FOREIGN KEY (instructeur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6F0A543225FCA809 ON les (instructeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE les DROP FOREIGN KEY FK_6F0A543225FCA809');
        $this->addSql('DROP INDEX IDX_6F0A543225FCA809 ON les');
        $this->addSql('ALTER TABLE les DROP instructeur_id');
    }
}
