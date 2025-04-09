<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class SpecificsTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/specifics.env');
    }

    #[Test]
    public function it_has_specifics()
    {
        $this->assertSame('value', Env::string('ONLY_CLOSING_SINGLE_QUOTE'));
        $this->assertSame('value', Env::string('ONLY_OPENING_SINGLE_QUOTE'));
        $this->assertSame("val'ue", Env::string('SINGLE_QUOTE_IN_THE_MIDDLE'));
        $this->assertSame('Will be trimmed.', Env::string('EXTRA_SPACES'));
        $this->assertSame('Will work!', Env::string('VAR WITH SPACES'));

        $this->assertSame('VAlue does tOo.', Env::string('VAR_RegiSter_Does_MATTER'));
    }
}
