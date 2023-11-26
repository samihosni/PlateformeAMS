<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123160622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, nom_cours VARCHAR(20) NOT NULL, volume_horaire INT NOT NULL, coefficient INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA147ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA147ECF78B0 ON note (cours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA147ECF78B0');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP INDEX IDX_CFBDFA147ECF78B0 ON note');
        $this->addSql('ALTER TABLE note DROP cours_id');
    }
}
