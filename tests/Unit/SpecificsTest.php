<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class SpecificsTest extends UnitTestCase
{
    protected function setUp(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/specifics.env');
    }

    public function specifics()
    {
        return [
            ['ONLY_CLOSING_SINGLE_QUOTE', 'value'],
            ['ONLY_OPENING_SINGLE_QUOTE', 'value'],
            ['SINGLE_QUOTE_IN_THE_MIDDLE', "val'ue"],
            ['VAR_RegiSter_Does_Not_MATTER', 'VAlue does thOugh.'],
            ['EXTRA_SPACES', 'Will be trimmed.'],
            ['VAR WITH SPACES', 'Will work!'],
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
