<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class NullTest extends UnitTestCase
{
    public static function setUpBeforeClass(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/null.env');
    }

    public function nullables()
    {
        return [
            ['VAR_NULL', null],
            ['VAR_NULL_SINGLE_QUOTED', null],
            ['VAR_NULL_DOUBLE_QUOTED', null],
        ];
    }

    /**
     * @test
     *
     * @dataProvider nullables
     *
     * @param $key
     * @param $value
     */
    public function it_understands_type_null($key, $value)
    {
        $this->assertSame($value, Env::get($key));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(3, count(Env::all()));
    }
}
