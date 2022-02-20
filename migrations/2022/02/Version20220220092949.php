<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\MealModule\Domain\ValueObject\MealKind;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220092949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create default meals';
    }

    public function up(Schema $schema): void
    {
        $mealKindOptions = array_values(MealKind::allValues());

        $values = [];
        $parameters = [];
        foreach ($mealKindOptions as $key => $mealKindOption) {
            $idKey = 'id_' . $key;
            $kindKey = 'kind_' . $key;

            $values[] = "(:$idKey, :$kindKey)";

            $parameters += [
                $idKey => MealId::generate()->value(),
                $kindKey => $mealKindOption,
            ];
        }

        $query = "INSERT INTO meal (`id`, `kind_value`) VALUES " . implode(', ', $values);

        $this->addSql($query, $parameters);
    }
}
