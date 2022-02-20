<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\MealModule\Domain\ValueObject\MealKind;
use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use PDO;

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
        $meals = $this->meals();

        $mealTemplateValues = [];
        $mealTemplateParameters = [];
        $relationValues = [];
        $relationParameters = [];
        foreach ($this->mealTeamplatesWithKinds() as $mealTemplateKey => $mealTemplateKinds) {
            $templateIdKey = 'id_' . $mealTemplateKey;

            $mealTemplateValues[] = "(:$templateIdKey)";

            $mealTemplateId = MealTemplateId::generate()->value();
            $mealTemplateParameters += [
                $templateIdKey => $mealTemplateId,
            ];

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
                $mealIdKey = 'meal_id_' . $mealTemplateKey . $key;
                $templateIdKey = 'template_id_' . $mealTemplateKey . $key;

                $relationValues[] = "(:$mealIdKey, :$templateIdKey)";
                $relationParameters += [
                    $mealIdKey => $mealId,
                    $templateIdKey => $mealTemplateId,
                ];
            }
        }

        $mealTemplateQuery = "INSERT INTO meal_template (`id`) VALUES " . implode(', ', $mealTemplateValues);
        $relationQuery = "INSERT INTO meal_template_meal (`meal_id`, `meal_template_id`) VALUES " . implode(', ',
                $relationValues);

        echo $mealTemplateQuery . "\n";
        echo $relationQuery . "\n";

        $this->addSql($mealTemplateQuery, $mealTemplateParameters);
        echo "funciona\n";
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
