<?php

declare(strict_types=1);

namespace Oct8pus;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \Oct8pus\RelaxedJson
 */
final class RelaxedJsonTest extends TestCase
{
    /**
     * @dataProvider provideCases
     *
     * @param string $input
     * @param array  $expected
     *
     * @return void
     */
    public function test(string $input, array $expected) : void
    {
        self::assertSame($expected, RelaxedJson::decode($input, true));
    }

    public static function provideCases() : iterable
    {
        return [
            [
                'input' => <<<'JSON'
                {
                    // library name
                    "name": "8ctopus/relaxed-json",
                }

                JSON,
                'expected' => [
                    'name' => '8ctopus/relaxed-json',
                ],
            ],
            [
                'input' => <<<'JSON'
                {
                    /*
                    library name
                    */
                    "name": "8ctopus/relaxed-json",
                }

                JSON,
                'expected' => [
                    'name' => '8ctopus/relaxed-json',
                ],
            ],
        ];
    }

    public function testException() : void
    {
        self::expectException(RelaxedJsonException::class);
        self::expectExceptionMessage('Syntax error');

        $text = <<<'JSON'
        {
            "throttleThreshold" => 300,
        }

        JSON;

        RelaxedJson::decode($text, true);
    }
}
