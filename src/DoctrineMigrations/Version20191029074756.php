<?php

declare(strict_types=1);

namespace App\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191029074756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amo_bank_account (id VARCHAR(255) NOT NULL, amo_bank_id VARCHAR(255) DEFAULT NULL, amo_owner_id VARCHAR(255) DEFAULT NULL, amo_updated_by_id VARCHAR(255) DEFAULT NULL, balance DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, bank_information_bank_code VARCHAR(255) NOT NULL, bank_information_box_code VARCHAR(255) NOT NULL, bank_information_number_account VARCHAR(255) NOT NULL, bank_information_rib_key VARCHAR(255) NOT NULL, bank_information_iban VARCHAR(255) NOT NULL, bank_information_bic VARCHAR(255) NOT NULL, INDEX IDX_196641525DBCFCF4 (amo_bank_id), INDEX IDX_19664152C57B52FD (amo_owner_id), INDEX IDX_19664152EC97A667 (amo_updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amo_bank_account ADD CONSTRAINT FK_196641525DBCFCF4 FOREIGN KEY (amo_bank_id) REFERENCES amo_bank (id)');
        $this->addSql('ALTER TABLE amo_bank_account ADD CONSTRAINT FK_19664152C57B52FD FOREIGN KEY (amo_owner_id) REFERENCES amo_user (id)');
        $this->addSql('ALTER TABLE amo_bank_account ADD CONSTRAINT FK_19664152EC97A667 FOREIGN KEY (amo_updated_by_id) REFERENCES amo_user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE amo_bank_account');
    }
}
