<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class IntegersTest extends UnitTestCase
{
    public static function setUpBeforeClass(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/integers.env');
    }

    public function integers()
    {
        return [
            ['VAR_INT', 4],
            ['VAR_INT_SINGLE_QUOTED', 8],
            ['VAR_INT_DOUBLE_QUOTED', 16],
            ['VAR_INT_NEGATIVE', -2],
            ['VAR_INT_ZERO', 0],
        ];
    }

    /**
     * @test
     *
     * @dataProvider integers
     *
     * @param $key
     * @param $value
     */
    public function it_understands_type_int($key, $value)
    {
        $this->assertSame($value, Env::get($key, 'default'));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(5, count(Env::all()));
    }
}
