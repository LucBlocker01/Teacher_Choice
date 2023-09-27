<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927074455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choice DROP CONSTRAINT fk_c1ab5a927d2d84d5');
        $this->addSql('DROP INDEX idx_c1ab5a927d2d84d5');
        $this->addSql('ALTER TABLE choice RENAME COLUMN professor_id TO teacher_id');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A9241807E1D FOREIGN KEY (teacher_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C1AB5A9241807E1D ON choice (teacher_id)');
        $this->addSql('ALTER TABLE "user" ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD lastname VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD firstname VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD mail VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD phone VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD postcode VARCHAR(5) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD city VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD adress VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6496BF700BD FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D93D6496BF700BD ON "user" (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6496BF700BD');
        $this->addSql('DROP INDEX IDX_8D93D6496BF700BD');
        $this->addSql('ALTER TABLE "user" DROP status_id');
        $this->addSql('ALTER TABLE "user" DROP lastname');
        $this->addSql('ALTER TABLE "user" DROP firstname');
        $this->addSql('ALTER TABLE "user" DROP mail');
        $this->addSql('ALTER TABLE "user" DROP phone');
        $this->addSql('ALTER TABLE "user" DROP postcode');
        $this->addSql('ALTER TABLE "user" DROP city');
        $this->addSql('ALTER TABLE "user" DROP adress');
        $this->addSql('ALTER TABLE choice DROP CONSTRAINT FK_C1AB5A9241807E1D');
        $this->addSql('DROP INDEX IDX_C1AB5A9241807E1D');
        $this->addSql('ALTER TABLE choice RENAME COLUMN teacher_id TO professor_id');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT fk_c1ab5a927d2d84d5 FOREIGN KEY (professor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c1ab5a927d2d84d5 ON choice (professor_id)');
    }
}
