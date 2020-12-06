<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class ArraysTest extends UnitTestCase
{
    public static function setUpBeforeClass(): void
    {
        (new Env())->reset()
            ->setArrays(['VAR_DOMAINS', 'VAR_PROTECTED', 'VAR_USERS'])
            ->read(__DIR__.'/../data/envs/arrays.env');
    }

    public function arrays()
    {
        return [
            [
                'VAR_DOMAINS',
                [
                    'laravel.com' => 'PHP framework for web artisans.',
                    'tailwindcss.com' => 'A utility-first CSS framework for rapidly building custom designs.',
                    'fontawesome.com' => 'Icons. Easy. Done.',
                ],
            ],
            [
                'VAR_PROTECTED',
                [
                    0 => 'password',
                    1 => '_token',
                    '' => 'Without a key, second overwrites the first.',
                ],
            ],
            ['PUB_VAR_PROTECTED_1', "Won't be treated as array."],
            ['VAR_USERS', "Won't be treated as array."],
        ];
    }

    /**
     * @test
     *
     * @dataProvider arrays
     *
     * @param $key
     * @param $value
     */
    public function it_supports_arrays($key, $value)
    {
        $this->assertSame($value, Env::get($key, []));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(4, count(Env::all()));
    }
}
