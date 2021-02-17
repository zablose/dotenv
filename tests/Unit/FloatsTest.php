<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class FloatsTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/floats.env');
    }

    public function floats()
    {
        return [
            ['VAR_FLOAT', 4.0],
            ['VAR_FLOAT_SINGLE_QUOTED', 8.01],
            ['VAR_FLOAT_DOUBLE_QUOTED', 16.02],
            ['VAR_FLOAT_NEGATIVE', -2.48],
            ['VAR_FLOAT_ZERO', 0.0],
        ];
    }

    /**
     * @test
     *
     * @dataProvider floats
     *
     * @param $key
     * @param $value
     */
    public function it_understands_type_float($key, $value)
    {
        $this->assertSame($value, env($key, 'default'));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(5, count(Env::all()));
    }
}
