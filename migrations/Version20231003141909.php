<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003141909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE week DROP CONSTRAINT fk_5b5a69c04b20cabd');
        $this->addSql('DROP INDEX idx_5b5a69c04b20cabd');
        $this->addSql('ALTER TABLE week DROP week_status_id');
        $this->addSql('ALTER TABLE week_status ADD week_id INT NOT NULL');
        $this->addSql('ALTER TABLE week_status ADD CONSTRAINT FK_F7A1C4FC86F3B2F FOREIGN KEY (week_id) REFERENCES week (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F7A1C4FC86F3B2F ON week_status (week_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE week ADD week_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE week ADD CONSTRAINT fk_5b5a69c04b20cabd FOREIGN KEY (week_status_id) REFERENCES week_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5b5a69c04b20cabd ON week (week_status_id)');
        $this->addSql('ALTER TABLE week_status DROP CONSTRAINT FK_F7A1C4FC86F3B2F');
        $this->addSql('DROP INDEX IDX_F7A1C4FC86F3B2F');
        $this->addSql('ALTER TABLE week_status DROP week_id');
    }
}
