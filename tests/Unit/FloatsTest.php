<?php declare(strict_types=1);

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
    public function get_method_understands_float()
    {
        $this->assertSame(4.0, Env::get('VAR_FLOAT'));
        $this->assertSame(8.01, Env::get('VAR_FLOAT_SINGLE_QUOTED'));
        $this->assertSame(16.02, Env::get('VAR_FLOAT_DOUBLE_QUOTED'));
        $this->assertSame(-2.48, Env::get('VAR_FLOAT_NEGATIVE'));
        $this->assertSame(0.0, Env::get('VAR_FLOAT_ZERO'));
    }

    /** @test */
    public function float_method_gets_float_from_floats_and_int()
    {
        $this->assertSame(4.0, Env::float('VAR_FLOAT'));
        $this->assertSame(13.0, Env::float('VAR_INT'));
    }

    /** @test */
    public function float_method_fails_on_wrong_type_values_but_int()
    {
        $this->expectException(TypeError::class);

        Env::float('VAR_STRING');
        Env::float('VAR_BOOL');
        Env::float('VAR_NULL');
        Env::float('VAR_ARRAY');
        Env::float('VAR_EMPTY');
    }

    /** @test */
    public function count_variables()
    {
        $this->assertSame(11, count(Env::all()));
    }
}
