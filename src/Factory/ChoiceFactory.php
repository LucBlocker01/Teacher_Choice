<?php

namespace App\Factory;

use App\Entity\Choice;
use App\Repository\ChoiceRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Choice>
 *
 * @method        Choice|Proxy                     create(array|callable $attributes = [])
 * @method static Choice|Proxy                     createOne(array $attributes = [])
 * @method static Choice|Proxy                     find(object|array|mixed $criteria)
 * @method static Choice|Proxy                     findOrCreate(array $attributes)
 * @method static Choice|Proxy                     first(string $sortedField = 'id')
 * @method static Choice|Proxy                     last(string $sortedField = 'id')
 * @method static Choice|Proxy                     random(array $attributes = [])
 * @method static Choice|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ChoiceRepository|RepositoryProxy repository()
 * @method static Choice[]|Proxy[]                 all()
 * @method static Choice[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Choice[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Choice[]|Proxy[]                 findBy(array $attributes)
 * @method static Choice[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Choice[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ChoiceFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $year = self::faker()->numberBetween(2021, 2023);

        return [
            'nbGroupSelected' => self::faker()->numberBetween(1, 4),
            'nbGroupAttributed' => null,
            'LessonInformation' => LessonInformationFactory::random(),
            'teacher' => UserFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Choice $choice): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Choice::class;
    }
}
