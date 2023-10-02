<?php

namespace App\Factory;

use App\Entity\Week;
use App\Repository\WeekRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Week>
 *
 * @method        Week|Proxy                     create(array|callable $attributes = [])
 * @method static Week|Proxy                     createOne(array $attributes = [])
 * @method static Week|Proxy                     find(object|array|mixed $criteria)
 * @method static Week|Proxy                     findOrCreate(array $attributes)
 * @method static Week|Proxy                     first(string $sortedField = 'id')
 * @method static Week|Proxy                     last(string $sortedField = 'id')
 * @method static Week|Proxy                     random(array $attributes = [])
 * @method static Week|Proxy                     randomOrCreate(array $attributes = [])
 * @method static WeekRepository|RepositoryProxy repository()
 * @method static Week[]|Proxy[]                 all()
 * @method static Week[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Week[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Week[]|Proxy[]                 findBy(array $attributes)
 * @method static Week[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Week[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class WeekFactory extends ModelFactory
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
        return [
            'weekNum' => self::faker()->numberBetween(1, 52),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Week $week): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Week::class;
    }
}
