<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002090449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE lesson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lesson_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subject_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE week_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE week_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE lesson (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE lesson_subject (lesson_id INT NOT NULL, subject_id INT NOT NULL, PRIMARY KEY(lesson_id, subject_id))');
        $this->addSql('CREATE INDEX IDX_EB26CDDCDF80196 ON lesson_subject (lesson_id)');
        $this->addSql('CREATE INDEX IDX_EB26CDD23EDC87 ON lesson_subject (subject_id)');
        $this->addSql('CREATE TABLE lesson_type (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subject (id INT NOT NULL, semester_id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FBCE3E7A4A798B6F ON subject (semester_id)');
        $this->addSql('CREATE TABLE week (id INT NOT NULL, week_num INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE week_status (id INT NOT NULL, holiday BOOLEAN NOT NULL, work_study BOOLEAN NOT NULL, internship BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE lesson_subject ADD CONSTRAINT FK_EB26CDDCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson_subject ADD CONSTRAINT FK_EB26CDD23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A4A798B6F FOREIGN KEY (semester_id) REFERENCES semester (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE semester ADD year INT NOT NULL');
        $this->addSql('ALTER TABLE semester DROP internship');
        $this->addSql('ALTER TABLE semester DROP work_study_program');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE lesson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lesson_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subject_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE week_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE week_status_id_seq CASCADE');
        $this->addSql('ALTER TABLE lesson_subject DROP CONSTRAINT FK_EB26CDDCDF80196');
        $this->addSql('ALTER TABLE lesson_subject DROP CONSTRAINT FK_EB26CDD23EDC87');
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT FK_FBCE3E7A4A798B6F');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE lesson_subject');
        $this->addSql('DROP TABLE lesson_type');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE week');
        $this->addSql('DROP TABLE week_status');
        $this->addSql('ALTER TABLE semester ADD internship BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE semester ADD work_study_program BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE semester DROP year');
    }
}
