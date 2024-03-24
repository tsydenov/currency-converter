<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240323115300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE rates_source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rates_source (id INT NOT NULL, source VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN rates_source.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE rate ADD rates_source_id INT NOT NULL');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39FE8DEA77 FOREIGN KEY (rates_source_id) REFERENCES rates_source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DFEC3F39FE8DEA77 ON rate (rates_source_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rate DROP CONSTRAINT FK_DFEC3F39FE8DEA77');
        $this->addSql('DROP SEQUENCE rates_source_id_seq CASCADE');
        $this->addSql('DROP TABLE rates_source');
        $this->addSql('DROP INDEX IDX_DFEC3F39FE8DEA77');
        $this->addSql('ALTER TABLE rate DROP rates_source_id');
    }
}
