<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005093105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson_subject DROP CONSTRAINT fk_eb26cddcdf80196');
        $this->addSql('ALTER TABLE lesson_subject DROP CONSTRAINT fk_eb26cdd23edc87');
        $this->addSql('DROP TABLE lesson_subject');
        $this->addSql('ALTER TABLE lesson ADD subject_id INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F87474F323EDC87 ON lesson (subject_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE lesson_subject (lesson_id INT NOT NULL, subject_id INT NOT NULL, PRIMARY KEY(lesson_id, subject_id))');
        $this->addSql('CREATE INDEX idx_eb26cdd23edc87 ON lesson_subject (subject_id)');
        $this->addSql('CREATE INDEX idx_eb26cddcdf80196 ON lesson_subject (lesson_id)');
        $this->addSql('ALTER TABLE lesson_subject ADD CONSTRAINT fk_eb26cddcdf80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson_subject ADD CONSTRAINT fk_eb26cdd23edc87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lesson DROP CONSTRAINT FK_F87474F323EDC87');
        $this->addSql('DROP INDEX IDX_F87474F323EDC87');
        $this->addSql('ALTER TABLE lesson DROP subject_id');
    }
}
