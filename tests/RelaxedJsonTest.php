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
     * @dataProvider getCases
     *
     * @param string $input
     * @param array $expected
     *
     * @return void
     */
    public function testAutoDetect(string $input, array $expected) : void
    {
        static::assertEquals($expected, RelaxedJson::decode($input, true));
    }

    public static function getCases() : array
    {
        return [
            [
                'input' => <<<JSON
                {
                    // library name
                    "name": "8ctopus/relaxed-json",
                }

                JSON,
                'expected' => [
                    "name" => "8ctopus/relaxed-json",
                ],
            ],
            [
                'input' => <<<JSON
                {
                    /*
                    library name
                    */
                    "name": "8ctopus/relaxed-json",
                }

                JSON,
                'expected' => [
                    "name" => "8ctopus/relaxed-json",
                ],
            ],
        ];
    }

    public function testException() : void
    {
        static::expectException(RelaxedJsonException::class);
        static::expectExceptionMessage('Syntax error');

        $text = <<<JSON
        {
            "throttleThreshold" => 300,
        }

        JSON;

        RelaxedJson::decode($text, true);
    }
}
