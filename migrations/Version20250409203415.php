<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409203415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE easy_admin__user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__loc AS SELECT id, title, content, locale, order_idx, obj_count FROM loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE loc
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE loc (id INTEGER NOT NULL, title CLOB NOT NULL --(DC2Type:json_translation)
            , content CLOB NOT NULL --(DC2Type:json_translation)
            , locale VARCHAR(2) NOT NULL, order_idx INTEGER DEFAULT NULL, obj_count INTEGER DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO loc (id, title, content, locale, order_idx, obj_count) SELECT id, title, content, locale, order_idx, obj_count FROM __temp__loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__loc
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE easy_admin__user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, enabled BOOLEAN NOT NULL, firstname VARCHAR(255) DEFAULT NULL COLLATE "BINARY", lastname VARCHAR(255) DEFAULT NULL COLLATE "BINARY", email VARCHAR(255) NOT NULL COLLATE "BINARY", roles CLOB NOT NULL COLLATE "BINARY" --(DC2Type:json)
            , password VARCHAR(255) NOT NULL COLLATE "BINARY")
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_AAFD4C04E7927C74 ON easy_admin__user (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) DEFAULT NULL COLLATE "BINARY", roles CLOB NOT NULL COLLATE "BINARY" --(DC2Type:json)
            , password VARCHAR(255) NOT NULL COLLATE "BINARY", is_verified BOOLEAN NOT NULL, code VARCHAR(48) NOT NULL COLLATE "BINARY", name VARCHAR(255) DEFAULT NULL COLLATE "BINARY", cel VARCHAR(255) DEFAULT NULL COLLATE "BINARY", is_artist BOOLEAN DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON users (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__loc AS SELECT id, title, content, locale, order_idx, obj_count FROM loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE loc
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE loc (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title CLOB NOT NULL --(DC2Type:json_translation)
            , content CLOB NOT NULL --(DC2Type:json_translation)
            , locale VARCHAR(2) NOT NULL, order_idx INTEGER DEFAULT NULL, obj_count INTEGER DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO loc (id, title, content, locale, order_idx, obj_count) SELECT id, title, content, locale, order_idx, obj_count FROM __temp__loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__loc
        SQL);
    }
}
