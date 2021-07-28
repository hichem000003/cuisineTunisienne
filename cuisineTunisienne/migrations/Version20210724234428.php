<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724234428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape ADD recettes_id INT NOT NULL');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_285F75DD3E2ED6D6 ON etape (recettes_id)');
        $this->addSql('ALTER TABLE recette ADD categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390A21214B7 ON recette (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD3E2ED6D6');
        $this->addSql('DROP INDEX IDX_285F75DD3E2ED6D6 ON etape');
        $this->addSql('ALTER TABLE etape DROP recettes_id');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390A21214B7');
        $this->addSql('DROP INDEX IDX_49BB6390A21214B7 ON recette');
        $this->addSql('ALTER TABLE recette DROP categories_id');
    }
}
