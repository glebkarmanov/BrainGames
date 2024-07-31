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

function playGame(string $name, string $gameType): bool
{
    $i = 0;

    while ($i < 3) {
        switch ($gameType) {
            case 'calc':
                $isCorrect = askQuestionCalc();
                break;
            case 'even':
                $isCorrect = askQuestionEven();
                break;
            case 'gcd':
                $isCorrect = askQuestionGcd();
                break;
            case 'progression':
                $isCorrect = askQuestionProgression();
                break;
            case 'prime':
                $isCorrect = askQuestionPrime();
                break;
        }

        if ($isCorrect) {
            $i++;
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
