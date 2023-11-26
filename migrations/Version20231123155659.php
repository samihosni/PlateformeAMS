<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123155659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom_filiere VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere_module (filiere_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_33E870B7180AA129 (filiere_id), INDEX IDX_33E870B7AFC2B591 (module_id), PRIMARY KEY(filiere_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filiere_module ADD CONSTRAINT FK_33E870B7180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_module ADD CONSTRAINT FK_33E870B7AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filiere_module DROP FOREIGN KEY FK_33E870B7180AA129');
        $this->addSql('ALTER TABLE filiere_module DROP FOREIGN KEY FK_33E870B7AFC2B591');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE filiere_module');
    }
}
