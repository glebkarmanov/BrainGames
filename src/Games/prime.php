#!/usr/bin/env php
<?php

namespace BrainGames\Games\Prime;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;

function greetUser(): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line('Answer "yes" if given number is prime. Otherwise answer "no".');
    return $name;
}

function askQuestionPrime(): bool
{
    $randomNumber = randomNumberForPrime();
    line("Question: $randomNumber");
    $answer = prompt("Your answer");
    return isAnswerCorrect($answer, $randomNumber);
}

function isAnswerCorrect(mixed $answer, mixed $randomValue): bool
{
    $result = checkPrime($randomValue);
    if (mb_strtolower($answer) === 'no' && $result == false) {
        return true;
    } elseif (mb_strtolower($answer) === 'yes' && $result == true) {
        return true;
    }
    return false;
}

function randomNumberForPrime(): int
{
    return random_int(1, 100);
}

function checkPrime(int $number): bool
{
    $i = 2;

    while ($i < $number) {
        if ($number % $i === 0) {
            return false;
        }
        $i += 1;
    }

    return true;
}

function startGame(string $gameType): void
{
    $name = greetUser();
    $askQuestionFunction = function () {
        return askQuestionPrime();
    };
    announceResult($name, $askQuestionFunction);
}

function startGamePrime(): void
{
    startGame('prime');
}
