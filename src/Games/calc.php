#!/usr/bin/env php
<?php

namespace BrainGames\Games\Calc;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\greetUser;
use function BrainGames\Engine\askQuestion;
use function BrainGames\Engine\isAnswerCorrect;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;
use function BrainGames\Engine\startGame;
function generateRandomExpression(): string
{
    $operators = ["+", "-", "*"];
    $operand1 = random_int(1, 99);
    $operand2 = random_int(1, 99);
    $i = array_rand($operators);
    $expression = "$operand1 $operators[$i] $operand2";
    return $expression;
}

function isAnswer(string $expression): int {
    $expression = str_replace(' ', '', $expression);

    if (preg_match('/^(\d+)([+\-*])(\d+)$/', $expression, $matches)) {
        $operand1 = (int)$matches[1];
        $operator = $matches[2];
        $operand2 = (int)$matches[3];

        switch ($operator) {
            case '+':
                return $operand1 + $operand2;
            case '-':
                return $operand1 - $operand2;
            case '*':
                return $operand1 * $operand2;
        }
    }

    return 0;
}

function startGameCalc(): void {
    startGame('calc');
}
