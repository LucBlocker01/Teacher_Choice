<?php

namespace App\Factory;

use App\Entity\LessonType;
use App\Repository\LessonTypeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<LessonType>
 *
 * @method        LessonType|Proxy                     create(array|callable $attributes = [])
 * @method static LessonType|Proxy                     createOne(array $attributes = [])
 * @method static LessonType|Proxy                     find(object|array|mixed $criteria)
 * @method static LessonType|Proxy                     findOrCreate(array $attributes)
 * @method static LessonType|Proxy                     first(string $sortedField = 'id')
 * @method static LessonType|Proxy                     last(string $sortedField = 'id')
 * @method static LessonType|Proxy                     random(array $attributes = [])
 * @method static LessonType|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LessonTypeRepository|RepositoryProxy repository()
 * @method static LessonType[]|Proxy[]                 all()
 * @method static LessonType[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static LessonType[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static LessonType[]|Proxy[]                 findBy(array $attributes)
 * @method static LessonType[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static LessonType[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LessonTypeFactory extends ModelFactory
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
            'name' => self::faker()->text(100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(LessonType $lessonType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return LessonType::class;
    }
}
