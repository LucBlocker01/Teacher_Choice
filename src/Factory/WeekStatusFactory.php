<?php

namespace App\Factory;

use App\Entity\WeekStatus;
use App\Repository\WeekStatusRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<WeekStatus>
 *
 * @method        WeekStatus|Proxy                     create(array|callable $attributes = [])
 * @method static WeekStatus|Proxy                     createOne(array $attributes = [])
 * @method static WeekStatus|Proxy                     find(object|array|mixed $criteria)
 * @method static WeekStatus|Proxy                     findOrCreate(array $attributes)
 * @method static WeekStatus|Proxy                     first(string $sortedField = 'id')
 * @method static WeekStatus|Proxy                     last(string $sortedField = 'id')
 * @method static WeekStatus|Proxy                     random(array $attributes = [])
 * @method static WeekStatus|Proxy                     randomOrCreate(array $attributes = [])
 * @method static WeekStatusRepository|RepositoryProxy repository()
 * @method static WeekStatus[]|Proxy[]                 all()
 * @method static WeekStatus[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static WeekStatus[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static WeekStatus[]|Proxy[]                 findBy(array $attributes)
 * @method static WeekStatus[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static WeekStatus[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class WeekStatusFactory extends ModelFactory
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
            'holiday' => self::faker()->boolean(),
            'internship' => self::faker()->boolean(),
            'work_study' => self::faker()->boolean(),
            'week' => WeekFactory::random(),
            'semester' => SemesterFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(WeekStatus $weekStatus): void {})
        ;
    }

    protected static function getClass(): string
    {
        return WeekStatus::class;
    }
}
