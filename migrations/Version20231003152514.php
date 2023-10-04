<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003152514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson_planning DROP CONSTRAINT fk_9cdef5efc86f3b2f');
        $this->addSql('DROP INDEX idx_9cdef5efc86f3b2f');
        $this->addSql('ALTER TABLE lesson_planning RENAME COLUMN week_id TO week_status_id');
        $this->addSql('ALTER TABLE lesson_planning ADD CONSTRAINT FK_9CDEF5EF4B20CABD FOREIGN KEY (week_status_id) REFERENCES week_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9CDEF5EF4B20CABD ON lesson_planning (week_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lesson_planning DROP CONSTRAINT FK_9CDEF5EF4B20CABD');
        $this->addSql('DROP INDEX IDX_9CDEF5EF4B20CABD');
        $this->addSql('ALTER TABLE lesson_planning RENAME COLUMN week_status_id TO week_id');
        $this->addSql('ALTER TABLE lesson_planning ADD CONSTRAINT fk_9cdef5efc86f3b2f FOREIGN KEY (week_id) REFERENCES week (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9cdef5efc86f3b2f ON lesson_planning (week_id)');
    }
}
