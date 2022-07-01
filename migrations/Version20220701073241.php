<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701073241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, code VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE list_rappel ADD country_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE list_rappel DROP country');
        $this->addSql('ALTER TABLE list_rappel ADD CONSTRAINT FK_A9EAEBE7EE96A67A FOREIGN KEY (country_code_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A9EAEBE7EE96A67A ON list_rappel (country_code_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE list_rappel DROP CONSTRAINT FK_A9EAEBE7EE96A67A');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP INDEX IDX_A9EAEBE7EE96A67A');
        $this->addSql('ALTER TABLE list_rappel ADD country VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE list_rappel DROP country_code_id');
    }
}
