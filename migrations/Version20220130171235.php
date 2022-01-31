<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130171235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proveedor ADD nombre TINYTEXT NOT NULL, ADD mail TINYTEXT NOT NULL, ADD telefono TINYTEXT NOT NULL, ADD tipo INT NOT NULL, ADD activo INT NOT NULL, ADD creado DATETIME NOT NULL, ADD editado DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proveedor DROP nombre, DROP mail, DROP telefono, DROP tipo, DROP activo, DROP creado, DROP editado');
    }
}
