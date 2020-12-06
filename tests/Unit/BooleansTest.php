<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class BooleansTest extends UnitTestCase
{
    public static function setUpBeforeClass(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/booleans.env');
    }

    public function booleans()
    {
        return [
            ['VAR_BOOL', true],
            ['VAR_BOOL_SINGLE_QUOTED', false],
            ['VAR_BOOL_DOUBLE_QUOTED', true],
        ];
    }

    /**
     * @test
     *
     * @dataProvider booleans
     *
     * @param $key
     * @param $value
     */
    public function it_understands_type_bool($key, $value)
    {
        $this->assertSame($value, env($key, 'default'));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(3, count(Env::all()));
    }
}
