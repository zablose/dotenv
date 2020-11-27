<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class NullTest extends UnitTestCase
{
    protected function setUp(): void
    {
        (new Env())->clear()->read(__DIR__.'/../data/envs/null.env');
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
