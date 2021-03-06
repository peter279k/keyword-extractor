<?php

namespace KeywordExtractor\Modifiers\Filters;

use PHPUnit\Framework\TestCase;

class EmptyFilterTest extends TestCase
{
    public function testModifyText()
    {
        $filter = new EmptyFilter();

        $inputsOutputs = [
            [
                'i' => '',
                'o' => '',
            ],
            [
                'i' => 0,
                'o' => 0,
            ],
            [
                'i' => '0',
                'o' => '0',
            ],
            [
                'i' => '0 ',
                'o' => '0 ',
            ],
            [
                'i' => 'test 0',
                'o' => 'test 0',
            ],
            [
                'i' => '   ',
                'o' => '',
            ],
        ];

        foreach ($inputsOutputs as $inputOutput) {
            $this->assertEquals($inputOutput['o'], $filter->modifyToken($inputOutput['i']));
        }
    }

    public function testModifyArray()
    {
        $filter = new EmptyFilter();

        $inputsOutputs = [
            [
                'i' => [],
                'o' => [],
            ],
            [
                'i' => ['test', 1, 0, '', '0', 'c#'],
                'o' => [0 => 'test', 1 => 1, 2 => 0, 4 => '0', 5 => 'c#'],
            ],
            [
                'i' => ['test 0', 1, 0, ' test', '0', ' '],
                'o' => ['test 0', 1, 0, ' test', '0'],
            ],
        ];

        foreach ($inputsOutputs as $inputOutput) {
            $this->assertEquals($inputOutput['o'], $filter->modifyTokens($inputOutput['i']));
        }
    }
}
