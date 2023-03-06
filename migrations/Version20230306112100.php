<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306112100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX ym_uid_fingerprint ON visitors_info');
        $this->addSql('CREATE UNIQUE INDEX ym_uid_fingerprint ON visitors_info (_ym_uid, fingerprint)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX ym_uid_fingerprint ON visitors_info');
        $this->addSql('CREATE INDEX ym_uid_fingerprint ON visitors_info (_ym_uid, fingerprint)');
    }
}
