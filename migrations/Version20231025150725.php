<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025150725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson_planning DROP CONSTRAINT fk_9cdef5ef4b20cabd');
        $this->addSql('DROP SEQUENCE week_status_id_seq CASCADE');
        $this->addSql('ALTER TABLE week_status DROP CONSTRAINT fk_f7a1c4f4a798b6f');
        $this->addSql('ALTER TABLE week_status DROP CONSTRAINT fk_f7a1c4fc86f3b2f');
        $this->addSql('DROP TABLE week_status');
        $this->addSql('DROP INDEX idx_9cdef5ef4b20cabd');
        $this->addSql('ALTER TABLE lesson_planning RENAME COLUMN week_status_id TO week_id');
        $this->addSql('ALTER TABLE lesson_planning ADD CONSTRAINT FK_9CDEF5EFC86F3B2F FOREIGN KEY (week_id) REFERENCES week (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9CDEF5EFC86F3B2F ON lesson_planning (week_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE week_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE week_status (id INT NOT NULL, semester_id INT DEFAULT NULL, week_id INT NOT NULL, holiday BOOLEAN NOT NULL, work_study BOOLEAN NOT NULL, internship BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f7a1c4fc86f3b2f ON week_status (week_id)');
        $this->addSql('CREATE INDEX idx_f7a1c4f4a798b6f ON week_status (semester_id)');
        $this->addSql('ALTER TABLE week_status ADD CONSTRAINT fk_f7a1c4f4a798b6f FOREIGN KEY (semester_id) REFERENCES semester (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE week_status ADD CONSTRAINT fk_f7a1c4fc86f3b2f FOREIGN KEY (week_id) REFERENCES week (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson_planning DROP CONSTRAINT FK_9CDEF5EFC86F3B2F');
        $this->addSql('DROP INDEX IDX_9CDEF5EFC86F3B2F');
        $this->addSql('ALTER TABLE lesson_planning RENAME COLUMN week_id TO week_status_id');
        $this->addSql('ALTER TABLE lesson_planning ADD CONSTRAINT fk_9cdef5ef4b20cabd FOREIGN KEY (week_status_id) REFERENCES week_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9cdef5ef4b20cabd ON lesson_planning (week_status_id)');
    }
}
