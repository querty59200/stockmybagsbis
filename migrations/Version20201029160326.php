<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201029160326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, featured_image VARCHAR(255) NOT NULL, INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_mot_clef (article_id INT NOT NULL, mot_clef_id INT NOT NULL, INDEX IDX_F82F848F7294869C (article_id), INDEX IDX_F82F848FE2959304 (mot_clef_id), PRIMARY KEY(article_id, mot_clef_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_934886107294869C (article_id), INDEX IDX_93488610BCF5E72D (categorie_id), PRIMARY KEY(article_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, slug VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, contenu LONGTEXT NOT NULL, actif TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, pseudo VARCHAR(30) NOT NULL, rgpd TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_67F068BC7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE luggage (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_clef (id INT AUTO_INCREMENT NOT NULL, mot_clef VARCHAR(50) NOT NULL, slug VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reaction (id INT AUTO_INCREMENT NOT NULL, luggage_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A4D707F77B18BD6A (luggage_id), INDEX IDX_A4D707F7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article_mot_clef ADD CONSTRAINT FK_F82F848F7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_mot_clef ADD CONSTRAINT FK_F82F848FE2959304 FOREIGN KEY (mot_clef_id) REFERENCES mot_clef (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886107294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F77B18BD6A FOREIGN KEY (luggage_id) REFERENCES luggage (id)');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_mot_clef DROP FOREIGN KEY FK_F82F848F7294869C');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_934886107294869C');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610BCF5E72D');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F77B18BD6A');
        $this->addSql('ALTER TABLE article_mot_clef DROP FOREIGN KEY FK_F82F848FE2959304');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE reaction DROP FOREIGN KEY FK_A4D707F7A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_mot_clef');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE luggage');
        $this->addSql('DROP TABLE mot_clef');
        $this->addSql('DROP TABLE reaction');
        $this->addSql('DROP TABLE user');
    }
}
