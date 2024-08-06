#!/usr/bin/env php
<?php

namespace BrainGames\Games\Gcd;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;

function greetUser(): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line('Find the greatest common divisor of given numbers.');
    return $name;
}

function askQuestionGcd(): bool
{
    $randomCommon = randomNumberForCommon();
    line("Question: $randomCommon");
    $answer = prompt('Your answer');
    return isAnswerCorrect($answer, $randomCommon);
}

function isAnswerCorrect(mixed $answer, mixed $randomValue): bool
{
    $array = splitStringIntoNumbers($randomValue);
    $result = answerRandomNumberForCommon($array);
    return $result == $answer;
}


function randomNumberForCommon(): string
{
    $number1 = random_int(1, 100);
    $number2 = random_int(1, 100);
    $result = "$number1 $number2";
    return $result;
}

function splitStringIntoNumbers(string $result): array
{
    // Разделяем строку по пробелу на массив
    $numbers = explode(' ', $result);

    // Преобразуем элементы массива в числа
    $number1 = (float)$numbers[0];
    $number2 = (float)$numbers[1];

    return [$number1, $number2];
}

function answerRandomNumberForCommon(array $randomNumbers): int
{

    $randomNumber1 = $randomNumbers[0];
    $randomNumber2 = $randomNumbers[1];

    /// Тут идет логика как из двух чисел на вход получить наибольший делитель
    if ($randomNumber1 === $randomNumber2) {
        return $randomNumber1;
    }
    $moreNumber = max($randomNumber1, $randomNumber2);
    $lowNumber = min($randomNumber1, $randomNumber2);

    /// Делим большее на меньшее и проверяем на остаток
    $divideNumber = $moreNumber % $lowNumber;
    if ($divideNumber === 0) {
        return $lowNumber;
    } else {
        return answerRandomNumberForCommon([$lowNumber, $divideNumber]);
    }
}

function startGame(string $gameType): void
{
    $name = greetUser();
    $askQuestionFunction = function() {
        return askQuestionGcd();
    };
    announceResult($name, $askQuestionFunction);
}

function startGameGcd(): void
{
    startGame('gcd');
}
