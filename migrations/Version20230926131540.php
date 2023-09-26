<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926131540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subject_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE status (id INT NOT NULL, status_id INT NOT NULL, name VARCHAR(40) NOT NULL, min_hours DOUBLE PRECISION DEFAULT NULL, max_hours DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subject_type (id INT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6496BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D6496BF700BD ON "user" (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6496BF700BD');
        $this->addSql('DROP SEQUENCE status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subject_type_id_seq CASCADE');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE subject_type');
        $this->addSql('DROP INDEX IDX_8D93D6496BF700BD');
        $this->addSql('ALTER TABLE "user" DROP status_id');
    }
}
