<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927080619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE semester_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE semester (id INT NOT NULL, name VARCHAR(2) NOT NULL, internship BOOLEAN NOT NULL, alternance BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE subject ADD semester_id INT NOT NULL');
        $this->addSql('ALTER TABLE subject DROP semester');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FBCE3E7A4A798B6F ON subject (semester_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT FK_FBCE3E7A4A798B6F');
        $this->addSql('DROP SEQUENCE semester_id_seq CASCADE');
        $this->addSql('DROP TABLE semester');
        $this->addSql('DROP INDEX IDX_FBCE3E7A4A798B6F');
        $this->addSql('ALTER TABLE subject ADD semester VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE subject DROP semester_id');
    }
}
