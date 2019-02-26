<?php

declare(strict_types=1);

namespace tests\unit\DroidSpeak;

use DroidSpeak\DroidSpeakTranslator;
use DroidSpeak\Exception\CanNotTranslateInputException;
use PHPUnit\Framework\TestCase;

class DroidSpeakTranslatorTest extends TestCase
{
    /** @var DroidSpeakTranslator */
    private $translator;

    /** @test */
    public function it_can_translate_empty_input(): void
    {
        $this->assertEmpty($this->translator->translate([]));
    }

    /** @test @dataProvider inputs */
    public function it_can_translate_multiple_inputs(array $expectedOutput, array $input): void
    {
        $this->assertEquals($expectedOutput, $this->translator->translate($input));
    }

    public function inputs(): array
    {
        return [
            [
                ['C'],
                ['01000011'],
            ],
            [
                [
                    'cell'  => 'Cell 2187',
                    'block' => 'Detention Block AA-23,',
                ],
                [
                    'cell'  => '01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111',
                    'block' => '01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100',
                ],
            ],
            [
                [
                    'cell'  => 'C',
                    'block' => 'D',
                ],
                [
                    'cell'  => '01000011',
                    'block' => '01000100',
                ],
            ],
            [
                [
                    'a' => ['e', 'c' => 'C'],
                    'b' => 'D',
                ],
                [
                    'a' => ['01100101', 'c' => '01000011'],
                    'b' => '01000100',
                ],
            ],
        ];
    }

    /** @test */
    public function it_fails_when_input_is_invalid(): void
    {
        $this->expectException(CanNotTranslateInputException::class);

        $this->translator->translate(['01000011xyz']);
    }

    protected function setUp(): void
    {
        $this->translator = new DroidSpeakTranslator();
    }
}
