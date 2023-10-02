<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002085320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT fk_fbce3e7ac54c8c93');
        $this->addSql('DROP SEQUENCE subject_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE slot_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE lesson_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE lesson_type (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE slot DROP CONSTRAINT fk_ac0e206723edc87');
        $this->addSql('DROP TABLE subject_type');
        $this->addSql('DROP TABLE slot');
        $this->addSql('ALTER TABLE choice DROP CONSTRAINT fk_c1ab5a9223edc87');
        $this->addSql('DROP INDEX idx_c1ab5a9223edc87');
        $this->addSql('ALTER TABLE choice DROP subject_id');
        $this->addSql('ALTER TABLE semester ADD year INT NOT NULL');
        $this->addSql('ALTER TABLE semester DROP internship');
        $this->addSql('ALTER TABLE semester DROP work_study_program');
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT fk_fbce3e7a4a798b6f');
        $this->addSql('DROP INDEX idx_fbce3e7a4a798b6f');
        $this->addSql('DROP INDEX idx_fbce3e7ac54c8c93');
        $this->addSql('ALTER TABLE subject DROP type_id');
        $this->addSql('ALTER TABLE subject DROP semester_id');
        $this->addSql('ALTER TABLE subject DROP year');
        $this->addSql('ALTER TABLE subject DROP nb_group');
        $this->addSql('ALTER TABLE subject DROP sae_support');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE lesson_type_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE subject_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE slot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subject_type (id INT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE slot (id INT NOT NULL, subject_id INT NOT NULL, week INT NOT NULL, nb_hours DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ac0e206723edc87 ON slot (subject_id)');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT fk_ac0e206723edc87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE lesson_type');
        $this->addSql('ALTER TABLE subject ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE subject ADD semester_id INT NOT NULL');
        $this->addSql('ALTER TABLE subject ADD year VARCHAR(4) NOT NULL');
        $this->addSql('ALTER TABLE subject ADD nb_group INT NOT NULL');
        $this->addSql('ALTER TABLE subject ADD sae_support VARCHAR(4) DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT fk_fbce3e7ac54c8c93 FOREIGN KEY (type_id) REFERENCES subject_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT fk_fbce3e7a4a798b6f FOREIGN KEY (semester_id) REFERENCES semester (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fbce3e7a4a798b6f ON subject (semester_id)');
        $this->addSql('CREATE INDEX idx_fbce3e7ac54c8c93 ON subject (type_id)');
        $this->addSql('ALTER TABLE choice ADD subject_id INT NOT NULL');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT fk_c1ab5a9223edc87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c1ab5a9223edc87 ON choice (subject_id)');
        $this->addSql('ALTER TABLE semester ADD internship BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE semester ADD work_study_program BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE semester DROP year');
    }
}
