<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class VariablesTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/variables.env');
    }

    public static function strings(): array
    {
        return [
            ['VAR_USER', 'zablose'],
            ['VAR_HOST', 'gmail.com'],
            ['VAR_EMAIL', 'zablose@gmail.com'],
            ['VAR_WWW', 'zablose.com'],
            ['VAR_UNDEFINED', 'undefined'],
            ['VAR_USED_BEFORE_SET', 'Use variables in order, after they were set.'],
            ['VAR_WITHOUT_END', '${VAR_USER.com'],
            ['VAR_WITHOUT_START', 'VAR_USER}.com'],
            ['VAR_WITH_WRONG_ORDER_OF_START_AND_END', '}VAR_USER${.com'],
        ];
    }

    #[Test]
    #[DataProvider('strings')]
    public function it_understands_variables(string $key, string $value)
    {
        $this->assertSame($value, Env::string($key));
    }
}
