<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class EnvTest extends UnitTestCase
{
    /** @test */
    public function it_is_possible_to_read_from_different_files()
    {
        (new Env())->reset()
            ->read(__DIR__.'/../data/envs/floats.env')
            ->read(__DIR__.'/../data/envs/integers.env')
            ->read(__DIR__.'/../data/envs/strings.env');

        $this->assertSame(4.0, Env::float('VAR_FLOAT'));
        $this->assertSame(4, Env::int('VAR_INT'));
        $this->assertSame('Just a string.', Env::string('VAR_STRING'));
    }

    /** @test */
    public function it_is_possible_to_get_all_variables_in_array()
    {
        (new Env())->reset()->setArrays(['VAR_ARRAY'])->read(__DIR__.'/../data/envs/mixed.env');

        $this->assertSame(7, count(Env::all()));
    }
}
