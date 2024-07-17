#!/usr/bin/env php
<?php

namespace BrainGames\Engine;

require_once __DIR__ . '/../vendor/autoload.php';

use function cli\line;
use function cli\prompt;

function greetUser($gameType): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    if ($gameType === 'calc') {
        line('What is the result of the expression?');
    } elseif ($gameType === 'even') {
        line('Answer "yes" if the number is even, otherwise answer "no".');
    } elseif ($gameType === 'gcd') {
        line('Find the greatest common divisor of given numbers.');
    } elseif ($gameType === 'progression') {
        line('What number is missing in the progression?');
    } elseif ($gameType === 'prime') {
        line('Answer "yes" if given number is prime. Otherwise answer "no".');
    }
    return $name;
}

/**
 * @return bool|null
 */
function askQuestion($gameType)
{
    if ($gameType === 'calc') {
        $randomExpression = generateRandomExpression();
        line("Question: $randomExpression");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomExpression, $gameType);
    } elseif ($gameType === 'even') {
        $randomNumber = generateRandomNumber();
        line("Question: $randomNumber");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomNumber, $gameType);
    } elseif ($gameType === 'gcd') {
        $randomCommon = randomNumberForCommon();
        line("Question: $randomCommon");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomCommon, $gameType);
    } elseif ($gameType === 'progression') {
        $randomNext = randomNext();
        $string = implode(' ', $randomNext[0]);
        line("Question: $string");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomNext[1], $gameType);
    } elseif ($gameType === 'prime') {
        $randomNumber = randomNumberForPrime();
        line("Question: $randomNumber");
        $answer = prompt("Your answer");
        return isAnswerCorrect($answer, $randomNumber, $gameType);
    }
}

/**
 * @return bool|null
 */
function isAnswerCorrect($answer, $randomValue, $gameType)
{
    if ($gameType === 'calc') {
        $result = isAnswer($randomValue);
        return $result == $answer;
    } elseif ($gameType === 'even') {
        return ($randomValue % 2 === 0 and $answer === "yes") ||
            ($randomValue % 2 !== 0 and $answer === "no");
    } elseif ($gameType === 'gcd') {
        $array = splitStringIntoNumbers($randomValue);
        $result = answerRandomNumberForCommon($array);
        return $result == $answer;
    } elseif ($gameType === 'progression') {
        return $answer == $randomValue;
    } elseif ($gameType === 'prime') {
        $result = checkPrime($randomValue);
        if (mb_strtolower($answer) === 'no' && $result == false) {
            return true;
        } elseif (mb_strtolower($answer) === 'yes' && $result == true) {
            return true;
        }
        return false;
    }
}

function playGame($name, $gameType): bool
{
    $i = 0;
    while ($i < 3) {
        if (askQuestion($gameType)) {
            $i = $i + 1;
            line("Correct!");
        } else {
            return false;
        }
    }
    return true;
}

function announceResult($name, $gameType): void
{
    if (playGame($name, $gameType)) {
        line("Congratulations, $name!");
    } else {
        line("Let's try again, $name!");
    }
}

function startGame($gameType): void
{
    $name = greetUser($gameType);
    announceResult($name, $gameType);
}
