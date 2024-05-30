<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529082940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE garbage_beach_kattegatt_ostersjon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year INTEGER NOT NULL, urban_beach INTEGER NOT NULL, rural_beach INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE garbage_material_kattegatt_ostersjon (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, material VARCHAR(255) NOT NULL, percentage INTEGER NOT NULL)');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, isbn, author, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO book (id, name, isbn, author, image) SELECT id, name, isbn, author, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE "BINARY", value INTEGER NOT NULL)');
        $this->addSql('DROP TABLE garbage_beach_kattegatt_ostersjon');
        $this->addSql('DROP TABLE garbage_material_kattegatt_ostersjon');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, isbn, author, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, isbn INTEGER NOT NULL, author VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO book (id, name, isbn, author, image) SELECT id, name, isbn, author, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
