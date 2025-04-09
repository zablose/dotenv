<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\UnitTestCase;
use Zablose\DotEnv\Env;

class UnicodeTest extends UnitTestCase
{
    public function setUp(): void
    {
        (new Env())->reset()->read(__DIR__.'/../data/envs/unicode.env');
    }

    public static function strings(): array
    {
        return [
            ['VAR_CH', '祝你今天過得愉快！再見。'],
            ['VAR_DE', 'Einen schönen Tag noch! Auf Wiedersehen.'],
            ['VAR_EN', 'Have a nice day! Goodbye.'],
            ['VAR_FI', 'Mukavaa päivää! Hyvästi.'],
            ['VAR_FR', 'Passe une bonne journée! Au revoir.'],
            ['VAR_IN', 'आपका दिन शुभ हो! अलविदा।'],
            ['VAR_JP', '良い一日を！さようなら。'],
            ['VAR_LV', 'Jauku dienu! Uz redzēšanos.'],
            ['VAR_RU', 'Хорошего дня! До свидания.'],
        ];
    }

    #[Test]
    #[DataProvider('strings')]
    public function it_understands_variables(string $key, string $value)
    {
        $this->assertSame($value, Env::string($key));
    }
}
