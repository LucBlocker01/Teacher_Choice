<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927071718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE slot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE slot (id INT NOT NULL, subject_id INT NOT NULL, week INT NOT NULL, nb_hours DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AC0E206723EDC87 ON slot (subject_id)');
        $this->addSql('ALTER TABLE slot ADD CONSTRAINT FK_AC0E206723EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d6496bf700bd');
        $this->addSql('DROP INDEX idx_8d93d6496bf700bd');
        $this->addSql('ALTER TABLE "user" ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP status_id');
        $this->addSql('ALTER TABLE "user" DROP lastname');
        $this->addSql('ALTER TABLE "user" DROP firstname');
        $this->addSql('ALTER TABLE "user" DROP mail');
        $this->addSql('ALTER TABLE "user" DROP phone');
        $this->addSql('ALTER TABLE "user" DROP cp');
        $this->addSql('ALTER TABLE "user" DROP city');
        $this->addSql('ALTER TABLE "user" DROP adress');
        $this->addSql('ALTER TABLE "user" ALTER login TYPE VARCHAR(180)');
        $this->addSql('ALTER TABLE "user" ALTER password TYPE VARCHAR(255)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (login)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE slot_id_seq CASCADE');
        $this->addSql('ALTER TABLE slot DROP CONSTRAINT FK_AC0E206723EDC87');
        $this->addSql('DROP TABLE slot');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('ALTER TABLE "user" ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD lastname VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD firstname VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD mail VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD phone VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD cp VARCHAR(5) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD city VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD adress VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" ALTER login TYPE VARCHAR(8)');
        $this->addSql('ALTER TABLE "user" ALTER password TYPE VARCHAR(40)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d6496bf700bd FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8d93d6496bf700bd ON "user" (status_id)');
    }
}
