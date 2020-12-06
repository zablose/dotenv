<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class SpecificsTest extends UnitTestCase
{
    public static function setUpBeforeClass(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/specifics.env');
    }

    public function specifics()
    {
        return [
            ['ONLY_CLOSING_SINGLE_QUOTE', 'value'],
            ['ONLY_OPENING_SINGLE_QUOTE', 'value'],
            ['SINGLE_QUOTE_IN_THE_MIDDLE', "val'ue"],
            ['EXTRA_SPACES', 'Will be trimmed.'],
            ['VAR WITH SPACES', 'Will work!'],

            ['VAR_RegiSter_Does_MATTER', 'VAlue does tOo.'],
            ['var_register_does_matter', null],
            ['VAR_REGISTER_DOES_MATTER', null],
        ];
    }

    /**
     * @test
     *
     * @dataProvider specifics
     *
     * @param $key
     * @param $value
     */
    public function it_has_specifics($key, $value)
    {
        $this->assertSame($value, Env::get($key));
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(6, count(Env::all()));
    }
}
