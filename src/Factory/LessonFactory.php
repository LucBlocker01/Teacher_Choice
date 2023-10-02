<?php

namespace App\Factory;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

use function Zenstruck\Foundry\faker;

/**
 * @extends ModelFactory<Lesson>
 *
 * @method        Lesson|Proxy                     create(array|callable $attributes = [])
 * @method static Lesson|Proxy                     createOne(array $attributes = [])
 * @method static Lesson|Proxy                     find(object|array|mixed $criteria)
 * @method static Lesson|Proxy                     findOrCreate(array $attributes)
 * @method static Lesson|Proxy                     first(string $sortedField = 'id')
 * @method static Lesson|Proxy                     last(string $sortedField = 'id')
 * @method static Lesson|Proxy                     random(array $attributes = [])
 * @method static Lesson|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LessonRepository|RepositoryProxy repository()
 * @method static Lesson[]|Proxy[]                 all()
 * @method static Lesson[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Lesson[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Lesson[]|Proxy[]                 findBy(array $attributes)
 * @method static Lesson[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Lesson[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LessonFactory extends ModelFactory
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
            'name' => faker()->text(25),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Lesson $lesson): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Lesson::class;
    }
}
