<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class StringsTest extends UnitTestCase
{
    public static function setUpBeforeClass(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/strings.env');
    }

    public function strings()
    {
        return [
            ['VAR_STRING', 'Just a string.'],
            ['VAR_STRING_SINGLE_QUOTED', 'Single quoted string.'],
            ['VAR_STRING_DOUBLE_QUOTED', 'Double quoted string.'],
            ['VAR_STRING_EMPTY', ''],
        ];
    }

    /**
     * @test
     *
     * @dataProvider strings
     *
     * @param $key
     * @param $value
     */
    public function it_understands_type_string($key, $value)
    {
        $this->assertSame($value, env($key, 'default'));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(4, count(Env::all()));
    }
}
