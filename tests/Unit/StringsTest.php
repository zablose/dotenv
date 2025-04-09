<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\UnitTestCase;
use TypeError;
use Zablose\DotEnv\Env;

class StringsTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->setArrays(['VAR_ARRAY'])
            ->read(__DIR__.'/../data/envs/strings.env')
            ->read(__DIR__.'/../data/envs/mixed.env');
    }

    #[Test]
    public function string_method_gets_string()
    {
        $this->assertSame('Hi', Env::string('VAR_STRING_HI'));
        $this->assertSame('', Env::string('VAR_EMPTY'));
        $this->assertSame('Just a string.', Env::string('VAR_STRING'));
        $this->assertSame('Single quoted string.', Env::string('VAR_STRING_SINGLE_QUOTED'));
        $this->assertSame('Double quoted string.', Env::string('VAR_STRING_DOUBLE_QUOTED'));
        $this->assertSame('', Env::string('VAR_STRING_EMPTY'));
    }

    #[Test]
    public function string_method_fails_on_array_value()
    {
        $this->expectException(TypeError::class);

        Env::string('VAR_ARRAY');
    }

    #[Test]
    public function string_method_fails_on_bool_value()
    {
        $this->expectException(TypeError::class);

        Env::string('VAR_BOOL_TRUE');
    }

    #[Test]
    public function string_method_fails_on_float_value()
    {
        $this->expectException(TypeError::class);

        Env::string('VAR_FLOAT_PI');
    }

    #[Test]
    public function string_method_fails_on_int_value()
    {
        $this->expectException(TypeError::class);

        Env::string('VAR_INT_TWO');
    }
}
