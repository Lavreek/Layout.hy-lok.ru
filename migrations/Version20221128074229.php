<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128074229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B0832512634F6D6 ON user_requests (u_ym_uid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A1BC12612634F6D6 ON user_visit (u_ym_uid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9B0832512634F6D6 ON user_requests');
        $this->addSql('DROP INDEX UNIQ_A1BC12612634F6D6 ON user_visit');
    }
}
