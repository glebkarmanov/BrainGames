#!/usr/bin/env php
<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;
use function BrainGames\Games\Calc\askQuestionCalc;
use function BrainGames\Games\Even\askQuestionEven;
use function BrainGames\Games\Gcd\askQuestionGcd;
use function BrainGames\Games\Prime\askQuestionPrime;
use function BrainGames\Games\Progression\askQuestionProgression;

function playGame(string $name, callable $askQuestionFunction): bool
{
    $i = 0;

    while ($i < 3) {
        $isCorrect = $askQuestionFunction();
        if ($isCorrect) {
            $i++;
            line("Correct!");
        } else {
            return false;
        }
    }
    return true;
}


function announceResult(string $name, callable $askQuestionFunction): void
{
    if (playGame($name, $askQuestionFunction)) {
        line("Congratulations, $name!");
    } else {
        line("Let's try again, $name!");
    }
}
