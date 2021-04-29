<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class HelpersTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->setArrays(['VAR_ARRAY'])->read(__DIR__.'/../data/envs/mixed.env');
    }

    /** @test */
    public function helper_functions_can_be_used()
    {
        $this->assertSame([1 => 'one', 2 => 'two'], env_array('VAR_ARRAY'));
        $this->assertSame(true, env_bool('VAR_BOOL_TRUE'));
        $this->assertSame(3.14, env_float('VAR_FLOAT_PI'));
        $this->assertSame(2, env_int('VAR_INT_TWO'));
        $this->assertSame('Hi', env_string('VAR_STRING_HI'));
    }
}
