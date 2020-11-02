<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201102082041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Cart (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE luggage ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE luggage ADD CONSTRAINT FK_5907C8DA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES Cart (id)');
        $this->addSql('CREATE INDEX IDX_5907C8DA1AD5CDBF ON luggage (cart_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE luggage DROP FOREIGN KEY FK_5907C8DA1AD5CDBF');
        $this->addSql('DROP TABLE Cart');
        $this->addSql('DROP INDEX IDX_5907C8DA1AD5CDBF ON luggage');
        $this->addSql('ALTER TABLE luggage DROP cart_id');
    }
}
