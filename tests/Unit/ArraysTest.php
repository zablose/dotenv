<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class ArraysTest extends UnitTestCase
{
    protected function setUp(): void
    {
        (new Env())->reset()->setArrays(['VAR_DOMAINS', 'VAR_PROTECTED'])->read(__DIR__.'/../data/envs/arrays.env');
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
                ],
            ],
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
        $this->assertSame(2, count(Env::all()));
    }
}
