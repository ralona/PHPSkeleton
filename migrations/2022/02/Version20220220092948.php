<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220092948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cheat_meal (id VARCHAR(36) NOT NULL, meal_id VARCHAR(255) DEFAULT NULL, weekday_value INT NOT NULL, week_number_value VARCHAR(15) NOT NULL, year_value INT NOT NULL, INDEX IDX_1E695B7A639666D6 (meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id VARCHAR(36) NOT NULL, kind_value VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_schedule (id VARCHAR(36) NOT NULL, meal_id VARCHAR(255) DEFAULT NULL, time_period_start_hours INT NOT NULL, time_period_start_minutes INT NOT NULL, time_period_start_seconds INT NOT NULL, time_period_end_hours INT NOT NULL, time_period_end_minutes INT NOT NULL, time_period_end_seconds INT NOT NULL, INDEX IDX_3E2A0A89639666D6 (meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_template (id VARCHAR(36) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_template_meal (meal_template_id VARCHAR(255) NOT NULL, meal_id VARCHAR(255) NOT NULL, INDEX IDX_51011E7D8200930 (meal_template_id), INDEX IDX_51011E7D639666D6 (meal_id), PRIMARY KEY(meal_template_id, meal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_schedule (id VARCHAR(36) NOT NULL, name_value VARCHAR(30) NOT NULL, time_period_start_hours INT NOT NULL, time_period_start_minutes INT NOT NULL, time_period_start_seconds INT NOT NULL, time_period_end_hours INT NOT NULL, time_period_end_minutes INT NOT NULL, time_period_end_seconds INT NOT NULL, weekday_value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheat_meal ADD CONSTRAINT FK_1E695B7A639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_schedule ADD CONSTRAINT FK_3E2A0A89639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_template_meal ADD CONSTRAINT FK_51011E7D8200930 FOREIGN KEY (meal_template_id) REFERENCES meal_template (id)');
        $this->addSql('ALTER TABLE meal_template_meal ADD CONSTRAINT FK_51011E7D639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cheat_meal DROP FOREIGN KEY FK_1E695B7A639666D6');
        $this->addSql('ALTER TABLE meal_schedule DROP FOREIGN KEY FK_3E2A0A89639666D6');
        $this->addSql('ALTER TABLE meal_template_meal DROP FOREIGN KEY FK_51011E7D639666D6');
        $this->addSql('ALTER TABLE meal_template_meal DROP FOREIGN KEY FK_51011E7D8200930');
        $this->addSql('DROP TABLE cheat_meal');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_schedule');
        $this->addSql('DROP TABLE meal_template');
        $this->addSql('DROP TABLE meal_template_meal');
        $this->addSql('DROP TABLE workout_schedule');
    }
}
