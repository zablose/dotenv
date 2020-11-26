<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class VariablesTest extends UnitTestCase
{
    protected function setUp(): void
    {
        (new Env())->clear()->read(__DIR__.'/../data/envs/variables.env');
    }

    public function strings()
    {
        return [
            ['VAR_USER', 'zablose'],
            ['VAR_HOST', 'gmail.com'],
            ['VAR_EMAIL', 'zablose@gmail.com'],
            ['VAR_WWW', 'zablose.com'],
            ['VAR_UNDEFINED', 'undefined'],
            ['VAR_USED_BEFORE_SET', 'Use variables in order, after they were set.'],
            ['VAR_WITHOUT_END', '${VAR_USER.com'],
            ['VAR_WITHOUT_START', 'VAR_USER}.com'],
            ['VAR_WITH_WRONG_ORDER_OF_START_AND_END', '}VAR_USER${.com'],
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
    public function it_understands_variables($key, $value)
    {
        $this->assertSame($value, Env::get($key, 'default'));
    }
}
