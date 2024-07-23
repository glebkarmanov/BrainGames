#!/usr/bin/env php
<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Games\Calc\generateRandomExpression;
use function BrainGames\Games\Calc\isAnswer;
use function BrainGames\Games\Even\generateRandomNumber;
use function BrainGames\Games\Gcd\randomNumberForCommon;
use function BrainGames\Games\Gcd\splitStringIntoNumbers;
use function BrainGames\Games\Gcd\answerRandomNumberForCommon;
use function BrainGames\Games\Prime\randomNumberForPrime;
use function BrainGames\Games\Prime\checkPrime;
use function BrainGames\Games\Progression\randomNext;

function greetUser(string $gameType): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    if ($gameType === 'calc.php') {
        line('What is the result of the expression?');
    } elseif ($gameType === 'even.php') {
        line('Answer "yes" if the number is even.php, otherwise answer "no".');
    } elseif ($gameType === 'gcd.php') {
        line('Find the greatest common divisor of given numbers.');
    } elseif ($gameType === 'progression.php') {
        line('What number is missing in the progression.php?');
    } elseif ($gameType === 'prime.php') {
        line('Answer "yes" if given number is prime.php. Otherwise answer "no".');
    }
    return $name;
}

function askQuestion(string $gameType)
{
    if ($gameType === 'calc.php') {
        $randomExpression = generateRandomExpression();
        line("Question: $randomExpression");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomExpression, $gameType);
    } elseif ($gameType === 'even.php') {
        $randomNumber = generateRandomNumber();
        line("Question: $randomNumber");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomNumber, $gameType);
    } elseif ($gameType === 'gcd.php') {
        $randomCommon = randomNumberForCommon();
        line("Question: $randomCommon");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomCommon, $gameType);
    } elseif ($gameType === 'progression.php') {
        $randomNext = randomNext();
        $string = implode(' ', $randomNext[0]);
        line("Question: $string");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomNext[1], $gameType);
    } elseif ($gameType === 'prime.php') {
        $randomNumber = randomNumberForPrime();
        line("Question: $randomNumber");
        $answer = prompt("Your answer");
        return isAnswerCorrect($answer, $randomNumber, $gameType);
    }
}


function isAnswerCorrect(mixed $answer, mixed $randomValue, string $gameType)
{
    if ($gameType === 'calc.php') {
        $result = isAnswer($randomValue);
        return $result == $answer;
    } elseif ($gameType === 'even.php') {
        return ($randomValue % 2 === 0 and $answer === "yes") ||
            ($randomValue % 2 !== 0 and $answer === "no");
    } elseif ($gameType === 'gcd.php') {
        $array = splitStringIntoNumbers($randomValue);
        $result = answerRandomNumberForCommon($array);
        return $result == $answer;
    } elseif ($gameType === 'progression.php') {
        return $answer == $randomValue;
    } elseif ($gameType === 'prime.php') {
        $result = checkPrime($randomValue);
        if (mb_strtolower($answer) === 'no' && $result == false) {
            return true;
        } elseif (mb_strtolower($answer) === 'yes' && $result == true) {
            return true;
        }
        return false;
    }
}

function playGame(string $name, string $gameType): bool
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

function announceResult(string $name, string $gameType): void
{
    if (playGame($name, $gameType)) {
        line("Congratulations, $name!");
    } else {
        line("Let's try again, $name!");
    }
}

function startGame(string $gameType): void
{
    $name = greetUser($gameType);
    announceResult($name, $gameType);
}
