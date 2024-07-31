#!/usr/bin/env php
<?php

namespace BrainGames\Games\Even;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;

function generateRandomNumber(): int
{
    return random_int(1, 99);
}

function greetUser(): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line('Answer "yes" if the number is even, otherwise answer "no".');
    return $name;
}

function askQuestionEven(): bool
{
    $randomNumber = generateRandomNumber();
    line("Question: $randomNumber");
    $answer = prompt('Your answer');
    return isAnswerCorrect($answer, $randomNumber);
}

function isAnswerCorrect(mixed $answer, mixed $randomValue): bool
{
    return ($randomValue % 2 === 0 and $answer === "yes") || ($randomValue % 2 !== 0 and $answer === "no");
}

function startGame(string $gameType): void
{
    $name = greetUser();
    announceResult($name, $gameType);
}
function startGameEven(): void
{
    startGame('even');
}
