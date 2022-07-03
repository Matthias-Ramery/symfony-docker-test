<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701132518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE list_rappels_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE list_rappel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, code VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE list_rappel (id INT NOT NULL, country_code_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone_number_national VARCHAR(15) NOT NULL, phone_number_international VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A9EAEBE7EE96A67A ON list_rappel (country_code_id)');
        $this->addSql('ALTER TABLE list_rappel ADD CONSTRAINT FK_A9EAEBE7EE96A67A FOREIGN KEY (country_code_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE list_rappels');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE list_rappel DROP CONSTRAINT FK_A9EAEBE7EE96A67A');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE list_rappel_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE list_rappels_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE list_rappels (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country VARCHAR(30) NOT NULL, phone_number_national VARCHAR(15) NOT NULL, phone_number_international VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE list_rappel');
    }
}
