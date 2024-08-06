#!/usr/bin/env php
<?php

namespace BrainGames\Games\Progression;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;

function greetUser(): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line('What number is missing in the progression?');
    return $name;
}

function askQuestionProgression(): bool
{
    $randomNext = randomNext();
    $string = implode(' ', $randomNext[0]);
    line("Question: $string");
    $answer = prompt('Your answer');
    return isAnswerCorrect($answer, $randomNext[1]);
}

function isAnswerCorrect(mixed $answer, mixed $randomValue): bool
{
    return $answer == $randomValue;
}

function randomNext(): array
{
    $startNext = random_int(1, 100);
    $step = random_int(2, 10);

    $result = [];

    $result[] = $startNext;
    $i = 0;
    $countProgress = 10;

    while ($i < $countProgress) {
        $newStep = $result[$i] + $step;
        $result[] = $newStep;
        $i = $i + 1;
    }

    $silent = array_rand($result, 1);
    $new = $result[$silent];

    $result[$silent] = '..';

    return [$result, $new];
}

function startGame(string $gameType): void
{
    $name = greetUser();
    $askQuestionFunction = function() {
        return askQuestionProgression();
    };
    announceResult($name, $askQuestionFunction);
}

function startGameProgression(): void
{
    startGame('progression');
}
