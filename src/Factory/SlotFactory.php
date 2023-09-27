<?php

namespace App\Factory;

use App\Entity\Slot;
use App\Repository\SlotRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Slot>
 *
 * @method        Slot|Proxy                     create(array|callable $attributes = [])
 * @method static Slot|Proxy                     createOne(array $attributes = [])
 * @method static Slot|Proxy                     find(object|array|mixed $criteria)
 * @method static Slot|Proxy                     findOrCreate(array $attributes)
 * @method static Slot|Proxy                     first(string $sortedField = 'id')
 * @method static Slot|Proxy                     last(string $sortedField = 'id')
 * @method static Slot|Proxy                     random(array $attributes = [])
 * @method static Slot|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SlotRepository|RepositoryProxy repository()
 * @method static Slot[]|Proxy[]                 all()
 * @method static Slot[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Slot[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Slot[]|Proxy[]                 findBy(array $attributes)
 * @method static Slot[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Slot[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SlotFactory extends ModelFactory
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
            'nb_hours' => self::faker()->randomFloat(),
            'subject' => SubjectFactory::new(),
            'week' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Slot $slot): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Slot::class;
    }
}
