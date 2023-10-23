<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023090048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, code VARCHAR(30) NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_lesson (tag_id INT NOT NULL, lesson_id INT NOT NULL, PRIMARY KEY(tag_id, lesson_id))');
        $this->addSql('CREATE INDEX IDX_11353DDFBAD26311 ON tag_lesson (tag_id)');
        $this->addSql('CREATE INDEX IDX_11353DDFCDF80196 ON tag_lesson (lesson_id)');
        $this->addSql('ALTER TABLE tag_lesson ADD CONSTRAINT FK_11353DDFBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_lesson ADD CONSTRAINT FK_11353DDFCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('ALTER TABLE tag_lesson DROP CONSTRAINT FK_11353DDFBAD26311');
        $this->addSql('ALTER TABLE tag_lesson DROP CONSTRAINT FK_11353DDFCDF80196');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_lesson');
    }
}
