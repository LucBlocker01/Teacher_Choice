<?php

namespace App\Factory;

use App\Entity\LessonPlanning;
use App\Repository\LessonPlanningRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<LessonPlanning>
 *
 * @method        LessonPlanning|Proxy                     create(array|callable $attributes = [])
 * @method static LessonPlanning|Proxy                     createOne(array $attributes = [])
 * @method static LessonPlanning|Proxy                     find(object|array|mixed $criteria)
 * @method static LessonPlanning|Proxy                     findOrCreate(array $attributes)
 * @method static LessonPlanning|Proxy                     first(string $sortedField = 'id')
 * @method static LessonPlanning|Proxy                     last(string $sortedField = 'id')
 * @method static LessonPlanning|Proxy                     random(array $attributes = [])
 * @method static LessonPlanning|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LessonPlanningRepository|RepositoryProxy repository()
 * @method static LessonPlanning[]|Proxy[]                 all()
 * @method static LessonPlanning[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static LessonPlanning[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static LessonPlanning[]|Proxy[]                 findBy(array $attributes)
 * @method static LessonPlanning[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static LessonPlanning[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LessonPlanningFactory extends ModelFactory
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
            'information' => LessonInformationFactory::new(),
            'nbHours' => self::faker()->randomNumber(),
            'week' => WeekFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(LessonPlanning $lessonPlanning): void {})
        ;
    }

    protected static function getClass(): string
    {
        return LessonPlanning::class;
    }
}
