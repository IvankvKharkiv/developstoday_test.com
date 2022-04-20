<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220419202421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE comments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comments (id INT NOT NULL, news_posts_id INT NOT NULL, author_name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962A9CDCFB94 ON comments (news_posts_id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9CDCFB94 FOREIGN KEY (news_posts_id) REFERENCES news_posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comments_id_seq CASCADE');
        $this->addSql('DROP TABLE comments');
    }
}
