#!/usr/bin/env php
<?php

namespace BrainGames\Games\Calc;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;

function greetUser(): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line('What is the result of the expression?');
    return $name;
}

function askQuestionCalc(): bool
{
    $randomExpression = generateRandomExpression();
    line("Question: $randomExpression");
    $answer = prompt('Your answer');
    return isAnswerCorrect($answer, $randomExpression);
}

function isAnswerCorrect(mixed $answer, mixed $randomValue): bool
{
    $result = isAnswer($randomValue);
    return $result == $answer;
}

function generateRandomExpression(): string
{
    $operators = ["+", "-", "*"];
    $operand1 = random_int(1, 99);
    $operand2 = random_int(1, 99);
    $i = array_rand($operators);
    $expression = "$operand1 $operators[$i] $operand2";

    return $expression;
}

function isAnswer(string $expression): int
{
    $expression = str_replace(' ', '', $expression);

    if (preg_match('/^(\d+)([+\-*])(\d+)$/', $expression, $matches) === 1) {
        $operand1 = (int)$matches[1];
        $operator = $matches[2];
        $operand2 = (int)$matches[3];

        switch ($operator) {
            case '+':
                $result = $operand1 + $operand2;
                return $result;

            case '-':
                return $operand1 - $operand2;

            case '*':
                return $operand1 * $operand2;
        }
    }

    return 0;
}

function startGame(string $gameType): void
{
    $name = greetUser();
    $askQuestionFunction = function () {
        return askQuestionCalc();
    };
    announceResult($name, $askQuestionFunction);
}

function startGameCalc(): void
{
    startGame('calc');
}
