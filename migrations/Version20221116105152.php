<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116105152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_requests (id INT AUTO_INCREMENT NOT NULL, u_email VARCHAR(255) NOT NULL, u_comment LONGTEXT NOT NULL, u_ip VARCHAR(15) NOT NULL, u_ym_uid VARCHAR(255) NOT NULL, u_geo LONGTEXT NOT NULL, u_width INT NOT NULL, created_at TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_visit (id INT AUTO_INCREMENT NOT NULL, u_ip VARCHAR(15) NOT NULL, site_page VARCHAR(255) NOT NULL, u_geo LONGTEXT NOT NULL, u_width INT NOT NULL, created_at TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_requests');
        $this->addSql('DROP TABLE user_visit');
    }
}
