<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use TypeError;
use Zablose\DotEnv\Env;

class FloatsTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->setArrays(['VAR_ARRAY'])
            ->read(__DIR__.'/../data/envs/floats.env')
            ->read(__DIR__.'/../data/envs/mixed.env');
    }

    /** @test */
    public function float_method_gets_float_from_floats_and_int()
    {
        $this->assertSame(3.14, Env::float('VAR_FLOAT_PI'));
        $this->assertSame(2.0, Env::float('VAR_INT_TWO'));
        $this->assertSame(4.0, Env::float('VAR_FLOAT'));
        $this->assertSame(8.01, Env::float('VAR_FLOAT_SINGLE_QUOTED'));
        $this->assertSame(16.02, Env::float('VAR_FLOAT_DOUBLE_QUOTED'));
        $this->assertSame(-2.48, Env::float('VAR_FLOAT_NEGATIVE'));
        $this->assertSame(0.0, Env::float('VAR_FLOAT_ZERO'));
    }

    /** @test */
    public function float_method_fails_on_array_value()
    {
        $this->expectException(TypeError::class);

        Env::float('VAR_ARRAY');
    }

    /** @test */
    public function float_method_fails_on_bool_value()
    {
        $this->expectException(TypeError::class);

        Env::float('VAR_BOOL_TRUE');
    }

    /** @test */
    public function float_method_fails_on_empty_value()
    {
        $this->expectException(TypeError::class);

        Env::float('VAR_EMPTY');
    }

    /** @test */
    public function float_method_fails_on_string_value()
    {
        $this->expectException(TypeError::class);

        Env::float('VAR_STRING_HI');
    }

    /** @test */
    public function float_method_fails_on_null_value()
    {
        $this->expectException(TypeError::class);

        Env::float('VAR_UNKNOWN');
    }
}
