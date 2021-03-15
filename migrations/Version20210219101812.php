<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219101812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critique ADD user_id INT NOT NULL, ADD film_id INT NOT NULL');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_1F950324A76ED395 ON critique (user_id)');
        $this->addSql('CREATE INDEX IDX_1F950324567F5183 ON critique (film_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324A76ED395');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324567F5183');
        $this->addSql('DROP INDEX IDX_1F950324A76ED395 ON critique');
        $this->addSql('DROP INDEX IDX_1F950324567F5183 ON critique');
        $this->addSql('ALTER TABLE critique DROP user_id, DROP film_id');
    }
}
