<?php

namespace App\Factory;

use App\Entity\SubjectType;
use App\Repository\SubjectTypeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SubjectType>
 *
 * @method        SubjectType|Proxy                     create(array|callable $attributes = [])
 * @method static SubjectType|Proxy                     createOne(array $attributes = [])
 * @method static SubjectType|Proxy                     find(object|array|mixed $criteria)
 * @method static SubjectType|Proxy                     findOrCreate(array $attributes)
 * @method static SubjectType|Proxy                     first(string $sortedField = 'id')
 * @method static SubjectType|Proxy                     last(string $sortedField = 'id')
 * @method static SubjectType|Proxy                     random(array $attributes = [])
 * @method static SubjectType|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SubjectTypeRepository|RepositoryProxy repository()
 * @method static SubjectType[]|Proxy[]                 all()
 * @method static SubjectType[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static SubjectType[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static SubjectType[]|Proxy[]                 findBy(array $attributes)
 * @method static SubjectType[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static SubjectType[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SubjectTypeFactory extends ModelFactory
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
            'name' => self::faker()->text(40),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SubjectType $subjectType): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SubjectType::class;
    }
}
