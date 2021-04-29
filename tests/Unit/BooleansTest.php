<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use TypeError;
use Zablose\DotEnv\Env;

class BooleansTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->setArrays(['VAR_ARRAY'])
            ->read(__DIR__.'/../data/envs/booleans.env')
            ->read(__DIR__.'/../data/envs/mixed.env');
    }

    /** @test */
    public function bool_method_gets_bool()
    {
        $this->assertSame(true, Env::bool('VAR_BOOL_TRUE'));
        $this->assertSame(true, Env::bool('VAR_BOOL'));
        $this->assertSame(false, Env::bool('VAR_BOOL_SINGLE_QUOTED'));
        $this->assertSame(true, Env::bool('VAR_BOOL_DOUBLE_QUOTED'));
    }

    /** @test */
    public function bool_method_fails_on_array_value()
    {
        $this->expectException(TypeError::class);

        Env::bool('VAR_ARRAY');
    }

    /** @test */
    public function bool_method_fails_on_float_value()
    {
        $this->expectException(TypeError::class);

        Env::bool('VAR_FLOAT_PI');
    }

    /** @test */
    public function bool_method_fails_on_int_value()
    {
        $this->expectException(TypeError::class);

        Env::bool('VAR_INT_TWO');
    }

    /** @test */
    public function bool_method_fails_on_empty_value()
    {
        $this->expectException(TypeError::class);

        Env::bool('VAR_EMPTY');
    }

    /** @test */
    public function bool_method_fails_on_string_value()
    {
        $this->expectException(TypeError::class);

        Env::bool('VAR_STRING_HI');
    }
}
