<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206112711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE lessen');
        $this->addSql('ALTER TABLE les ADD training_id INT NOT NULL');
        $this->addSql('ALTER TABLE les ADD CONSTRAINT FK_6F0A5432BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('CREATE INDEX IDX_6F0A5432BEFD98D1 ON les (training_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lessen (id INT AUTO_INCREMENT NOT NULL, training_id INT NOT NULL, tijd TIME NOT NULL, datum DATE NOT NULL, locatie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, max_personen INT NOT NULL, INDEX IDX_6F0A5432BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lessen ADD CONSTRAINT FK_6F0A5432BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE les DROP FOREIGN KEY FK_6F0A5432BEFD98D1');
        $this->addSql('DROP INDEX IDX_6F0A5432BEFD98D1 ON les');
        $this->addSql('ALTER TABLE les DROP training_id');
    }
}
