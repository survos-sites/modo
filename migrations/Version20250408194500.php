<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408194500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__loc AS SELECT id, title, content, locale, order_idx, obj_count FROM loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE loc
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE loc (id INTEGER NOT NULL, title CLOB NOT NULL, content CLOB NOT NULL, locale VARCHAR(2) NOT NULL, order_idx INTEGER DEFAULT NULL, obj_count INTEGER DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO loc (id, title, content, locale, order_idx, obj_count) SELECT id, title, content, locale, order_idx, obj_count FROM __temp__loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__loc
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE obj ADD COLUMN file TEXT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__loc AS SELECT id, title, content, locale, order_idx, obj_count FROM loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE loc
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE loc (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title CLOB NOT NULL, content CLOB NOT NULL, locale VARCHAR(2) NOT NULL, order_idx INTEGER DEFAULT NULL, obj_count INTEGER DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO loc (id, title, content, locale, order_idx, obj_count) SELECT id, title, content, locale, order_idx, obj_count FROM __temp__loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__loc
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__obj AS SELECT id, label, description, code, locale, info, location_id FROM obj
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE obj
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE obj (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, code VARCHAR(255) NOT NULL, locale VARCHAR(2) NOT NULL, info CLOB DEFAULT NULL, location_id INTEGER NOT NULL, CONSTRAINT FK_4666D46C64D218E FOREIGN KEY (location_id) REFERENCES loc (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO obj (id, label, description, code, locale, info, location_id) SELECT id, label, description, code, locale, info, location_id FROM __temp__obj
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__obj
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4666D46C64D218E ON obj (location_id)
        SQL);
    }
}
