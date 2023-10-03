<?php

namespace App\Factory;

use App\Entity\LessonInformation;
use App\Repository\LessonInformationRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<LessonInformation>
 *
 * @method        LessonInformation|Proxy                     create(array|callable $attributes = [])
 * @method static LessonInformation|Proxy                     createOne(array $attributes = [])
 * @method static LessonInformation|Proxy                     find(object|array|mixed $criteria)
 * @method static LessonInformation|Proxy                     findOrCreate(array $attributes)
 * @method static LessonInformation|Proxy                     first(string $sortedField = 'id')
 * @method static LessonInformation|Proxy                     last(string $sortedField = 'id')
 * @method static LessonInformation|Proxy                     random(array $attributes = [])
 * @method static LessonInformation|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LessonInformationRepository|RepositoryProxy repository()
 * @method static LessonInformation[]|Proxy[]                 all()
 * @method static LessonInformation[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static LessonInformation[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static LessonInformation[]|Proxy[]                 findBy(array $attributes)
 * @method static LessonInformation[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static LessonInformation[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LessonInformationFactory extends ModelFactory
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
            'lesson' => LessonFactory::new(),
            'lessonType' => LessonTypeFactory::new(),
            'nb_groups' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(LessonInformation $lessonInformation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return LessonInformation::class;
    }
}
