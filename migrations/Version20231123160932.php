<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123160932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, nom_enseignant VARCHAR(20) NOT NULL, prenom_enseignant VARCHAR(20) NOT NULL, adresse_mail_enseignant VARCHAR(30) NOT NULL, num_tel INT NOT NULL, INDEX IDX_81A72FA17ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA17ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE note ADD enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14E455FCC0 ON note (enseignant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14E455FCC0');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA17ECF78B0');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP INDEX IDX_CFBDFA14E455FCC0 ON note');
        $this->addSql('ALTER TABLE note DROP enseignant_id');
    }
}
