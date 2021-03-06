<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use TypeError;
use Zablose\DotEnv\Env;

class IntegersTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->setArrays(['VAR_ARRAY'])
            ->read(__DIR__.'/../data/envs/integers.env')
            ->read(__DIR__.'/../data/envs/mixed.env');
    }

    /** @test */
    public function int_method_gets_int()
    {
        $this->assertSame(2, Env::int('VAR_INT_TWO'));
        $this->assertSame(4, Env::int('VAR_INT'));
        $this->assertSame(8, Env::int('VAR_INT_SINGLE_QUOTED'));
        $this->assertSame(16, Env::int('VAR_INT_DOUBLE_QUOTED'));
        $this->assertSame(-2, Env::int('VAR_INT_NEGATIVE'));
        $this->assertSame(0, Env::int('VAR_INT_ZERO'));
    }

    /** @test */
    public function int_method_fails_on_array_value()
    {
        $this->expectException(TypeError::class);

        Env::int('VAR_ARRAY');
    }

    /** @test */
    public function int_method_fails_on_bool_value()
    {
        $this->expectException(TypeError::class);

        Env::int('VAR_BOOL_TRUE');
    }

    /** @test */
    public function int_method_fails_on_float_value()
    {
        $this->expectException(TypeError::class);

        Env::int('VAR_FLOAT_PI');
    }

    /** @test */
    public function int_method_fails_on_empty_value()
    {
        $this->expectException(TypeError::class);

        Env::int('VAR_EMPTY');
    }

    /** @test */
    public function int_method_fails_on_string_value()
    {
        $this->expectException(TypeError::class);

        Env::int('VAR_STRING_HI');
    }

    /** @test */
    public function int_method_fails_on_null_value()
    {
        $this->expectException(TypeError::class);

        Env::int('VAR_UNKNOWN');
    }
}
