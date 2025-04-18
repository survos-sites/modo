<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418130141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE easy_admin__reset_password_request (id SERIAL NOT NULL, user_id INT DEFAULT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_DB1E0C65A76ED395 ON easy_admin__reset_password_request (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN easy_admin__reset_password_request.requested_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN easy_admin__reset_password_request.expires_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE easy_media__folder (id SERIAL NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1C446171727ACA70 ON easy_media__folder (parent_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE easy_media__media (id SERIAL NOT NULL, folder_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, mime VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, last_modified INT DEFAULT NULL, metas JSON NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_83D7599C162CB942 ON easy_media__media (folder_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE expo (code VARCHAR(32) NOT NULL, PRIMARY KEY(code))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE expo_translation (id SERIAL NOT NULL, translatable_id VARCHAR(32) DEFAULT NULL, title VARCHAR(255) NOT NULL, content TEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_349B803F2C2AC5D3 ON expo_translation (translatable_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX expo_translation_unique_translation ON expo_translation (translatable_id, locale)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE loc (id INT NOT NULL, title JSONB NOT NULL, content JSONB NOT NULL, locale VARCHAR(2) NOT NULL, order_idx INT DEFAULT NULL, obj_count INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE media (id SERIAL NOT NULL, expo_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE obj (id SERIAL NOT NULL, location_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, code VARCHAR(255) NOT NULL, locale VARCHAR(2) NOT NULL, info TEXT DEFAULT NULL, file TEXT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4666D46C64D218E ON obj (location_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN obj.file IS '(DC2Type:easy_media_type)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE users (id SERIAL NOT NULL, enabled BOOLEAN NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, code VARCHAR(48) DEFAULT NULL, cel VARCHAR(255) DEFAULT NULL, is_artist BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE easy_admin__reset_password_request ADD CONSTRAINT FK_DB1E0C65A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE easy_media__folder ADD CONSTRAINT FK_1C446171727ACA70 FOREIGN KEY (parent_id) REFERENCES easy_media__folder (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE easy_media__media ADD CONSTRAINT FK_83D7599C162CB942 FOREIGN KEY (folder_id) REFERENCES easy_media__folder (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE expo_translation ADD CONSTRAINT FK_349B803F2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES expo (code) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE obj ADD CONSTRAINT FK_4666D46C64D218E FOREIGN KEY (location_id) REFERENCES loc (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE easy_admin__reset_password_request DROP CONSTRAINT FK_DB1E0C65A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE easy_media__folder DROP CONSTRAINT FK_1C446171727ACA70
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE easy_media__media DROP CONSTRAINT FK_83D7599C162CB942
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE expo_translation DROP CONSTRAINT FK_349B803F2C2AC5D3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE obj DROP CONSTRAINT FK_4666D46C64D218E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE easy_admin__reset_password_request
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE easy_media__folder
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE easy_media__media
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE expo
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE expo_translation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE loc
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE media
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE obj
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE users
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
