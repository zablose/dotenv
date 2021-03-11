<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use TypeError;
use Zablose\DotEnv\Env;

class ArraysTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()
            ->setArrays(['VAR_ARRAY', 'VAR_DOMAINS', 'VAR_PROTECTED', 'VAR_USERS'])
            ->read(__DIR__.'/../data/envs/arrays.env')
            ->read(__DIR__.'/../data/envs/mixed.env');
    }

    /** @test */
    public function array_method_gets_array()
    {
        $this->assertSame([1 => 'one', 2 => 'two'], Env::array('VAR_ARRAY'));
        $this->assertSame(
            [
                'laravel.com' => 'PHP framework for web artisans.',
                'tailwindcss.com' => 'A utility-first CSS framework for rapidly building custom designs.',
                'fontawesome.com' => 'Icons. Easy. Done.',
            ],
            Env::array('VAR_DOMAINS')
        );
        $this->assertSame(
            [
                0 => 'password',
                1 => '_token',
                '' => 'Without a key, second overwrites the first.',
            ],
            Env::array('VAR_PROTECTED')
        );
        $this->assertSame([], Env::array('VAR_ARRAY_UNKNOWN'));

        $this->assertSame("Won't be treated as array.", Env::string('PUB_VAR_PROTECTED_1'));
        $this->assertSame("Won't be treated as array.", Env::string('VAR_USERS'));
    }

    /** @test */
    public function array_method_fails_on_bool_value()
    {
        $this->expectException(TypeError::class);

        Env::array('VAR_BOOL_TRUE');
    }

    /** @test */
    public function array_method_fails_on_float_value()
    {
        $this->expectException(TypeError::class);

        Env::array('VAR_FLOAT_PI');
    }

    /** @test */
    public function array_method_fails_on_int_value()
    {
        $this->expectException(TypeError::class);

        Env::array('VAR_INT_TWO');
    }

    /** @test */
    public function array_method_fails_on_empty_value()
    {
        $this->expectException(TypeError::class);

        Env::array('VAR_EMPTY');
    }

    /** @test */
    public function array_method_fails_on_string_value()
    {
        $this->expectException(TypeError::class);

        Env::array('VAR_STRING_HI');
    }

    /** @test */
    public function array_method_fails_on_null_value()
    {
        $this->expectException(TypeError::class);

        Env::array('VAR_UNKNOWN', null);
    }
}
