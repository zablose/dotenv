<?php declare(strict_types=1);

namespace Tests\Unit;

use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class NullTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/null.env');
    }

    /** @test */
    public function it_understands_type_null()
    {
        $this->assertSame(null, Env::float('VAR_NULL'));
        $this->assertSame(null, Env::int('VAR_NULL_SINGLE_QUOTED'));
        $this->assertSame(null, Env::string('VAR_NULL_DOUBLE_QUOTED'));
    }
}
