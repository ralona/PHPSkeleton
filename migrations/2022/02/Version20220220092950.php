<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220092950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create default meal templates';
    }

    public function up(Schema $schema): void
    {
        $mealTemplateValues = [];
        $mealTemplateParameters = [];
        for ($mealTemplateKey = 0; $mealTemplateKey < 3; $mealTemplateKey++) {
            $templateIdKey = 'id_' . $mealTemplateKey;

            $mealTemplateValues[] = "(:$templateIdKey)";

            $mealTemplateId = MealTemplateId::generate()->value();
            $mealTemplateParameters += [
                $templateIdKey => $mealTemplateId,
            ];
        }

        $mealTemplateTable = $schema->getTable('meal_template');

        $mealTemplateQuery = "INSERT INTO {$mealTemplateTable->getName()} (`id`) VALUES " .
            implode(', ', $mealTemplateValues);

        $this->addSql($mealTemplateQuery, $mealTemplateParameters);
    }
}
