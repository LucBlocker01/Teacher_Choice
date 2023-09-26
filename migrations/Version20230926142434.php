<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926142434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE choice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE choice (id INT NOT NULL, professor_id INT NOT NULL, subject_id INT NOT NULL, nb_group_selected INT NOT NULL, year VARCHAR(4) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1AB5A927D2D84D5 ON choice (professor_id)');
        $this->addSql('CREATE INDEX IDX_C1AB5A9223EDC87 ON choice (subject_id)');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A927D2D84D5 FOREIGN KEY (professor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A9223EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE status DROP status_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE choice_id_seq CASCADE');
        $this->addSql('ALTER TABLE choice DROP CONSTRAINT FK_C1AB5A927D2D84D5');
        $this->addSql('ALTER TABLE choice DROP CONSTRAINT FK_C1AB5A9223EDC87');
        $this->addSql('DROP TABLE choice');
        $this->addSql('ALTER TABLE status ADD status_id INT NOT NULL');
    }
}
