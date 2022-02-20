<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\MealModule\Domain\Model\MealTemplate;
use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\MealModule\Domain\ValueObject\MealKind;
use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use PDO;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220092951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create default meal templates';
    }

    public function up(Schema $schema): void
    {
        $meals = $this->meals();
        $mealTemplates = $this->mealTemplates();

        $relationValues = [];
        $relationParameters = [];
        foreach ($this->mealTeamplatesWithKinds() as $mealTemplateKey => $mealTemplateKinds) {
            $mealIds = array_map(
                static function (MealKind $kind) use ($meals) {
                    /** @var Meal $meal */
                    $meal = current(array_filter(
                        $meals,
                        static fn(Meal $meal) => $meal->kind()->equals($kind)
                    ));

                    return $meal->id()->value();
                },
                $mealTemplateKinds
            );

            foreach ($mealIds as $key => $mealId) {
                $templateIdKey = 'template_id_' . $mealTemplateKey . $key;
                $mealIdKey = 'meal_id_' . $mealTemplateKey . $key;

                $relationValues[] = "(:$templateIdKey, :$mealIdKey)";
                $relationParameters += [
                    $templateIdKey => ($mealTemplates[$mealTemplateKey])->id()->value(),
                    $mealIdKey => $mealId,
                ];
            }
        }

        $relationTable = $schema->getTable('meal_template_meal');

        $relationQuery = "INSERT INTO {$relationTable->getName()} (`meal_template_id`, `meal_id`) VALUES " .
            implode(', ', $relationValues);

        $this->addSql($relationQuery, $relationParameters);
    }

    private function meals(): array
    {
        $select = $this->connection->executeQuery('SELECT * FROM meal');

        $meals = [];
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $meals[] = new Meal(
                new MealId($row['id']),
                new MealKind($row['kind_value']),
            );
        }

        return $meals;
    }

    /** @return MealTemplate[] */
    private function mealTemplates(): array
    {
        $select = $this->connection->executeQuery('SELECT * FROM meal_template');

        $mealTemplates = [];
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $mealTemplates[] = new MealTemplate(
                new MealTemplateId($row['id']),
            );
        }

        return $mealTemplates;
    }

    private function mealTeamplatesWithKinds(): array
    {
        return [
            [
                MealKind::breakfast(),
                MealKind::lunch(),
                MealKind::dinner(),
            ],
            [
                MealKind::breakfast(),
                MealKind::brunch(),
                MealKind::lunch(),
                MealKind::tea(),
                MealKind::dinner(),
            ],
            [
                MealKind::breakfast(),
                MealKind::brunch(),
                MealKind::elevenses(),
                MealKind::lunch(),
                MealKind::tea(),
                MealKind::supper(),
                MealKind::dinner(),
            ],
        ];
    }
}
