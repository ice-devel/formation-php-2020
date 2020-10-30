<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201030103215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainee (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, name VARCHAR(50) NOT NULL, phone VARCHAR(10) NOT NULL, birthdate DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trainee_skill (trainee_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_B103175A36C682D0 (trainee_id), INDEX IDX_B103175A5585C142 (skill_id), PRIMARY KEY(trainee_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trainee_skill ADD CONSTRAINT FK_B103175A36C682D0 FOREIGN KEY (trainee_id) REFERENCES trainee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trainee_skill ADD CONSTRAINT FK_B103175A5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trainee_skill DROP FOREIGN KEY FK_B103175A5585C142');
        $this->addSql('ALTER TABLE trainee_skill DROP FOREIGN KEY FK_B103175A36C682D0');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE trainee');
        $this->addSql('DROP TABLE trainee_skill');
    }
}
