#!/usr/bin/env php
<?php

namespace BrainGames\Engine;

require_once 'vendor/autoload.php';

use function cli\line;
use function cli\prompt;

function greetUser($gameType)
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    if ($gameType === 'calc') {
        line('What is the result of the expression?');
    } elseif ($gameType === 'even') {
        line('Answer "yes" if the number is even, otherwise answer "no"');
    }
    elseif ($gameType === 'gcd') {
        line('Find the greatest common divisor of given numbers.');
    }
    return $name;
}

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
    }
    elseif ($gameType === 'gcd') {
        $randomCommon = randomNumberForCommon();
        line("Question: $randomCommon");
        $answer = prompt('Your answer');
        return isAnswerCorrect($answer, $randomCommon, $gameType);
    }
}

function isAnswerCorrect($answer, $randomValue, $gameType)
{
    if ($gameType === 'calc') {
        $result = isAnswer($randomValue);
        return $result == $answer;
    } elseif ($gameType === 'even') {
        return ($randomValue % 2 === 0 and $answer === "yes") ||
            ($randomValue % 2 !== 0 and $answer === "no");
    }
    elseif ($gameType === 'gcd') {
        $array = splitStringIntoNumbers($randomValue);
        $result = answerRandomNumberForCommon($array);
        return $result == $answer;
    }
}

function playGame($name, $gameType)
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

function announceResult($name, $gameType)
{
    if (playGame($name, $gameType)) {
        line("Congratulations, $name!");
    } else {
        line("Let's try again, $name!");
    }
}

function startGame($gameType)
{
    $name = greetUser($gameType);
    announceResult($name, $gameType);
}