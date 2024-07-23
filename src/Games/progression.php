#!/usr/bin/env php
<?php

namespace BrainGames\Games\Progression;

use function BrainGames\Engine\startGame;

function randomNext (): array {
    $startNext = random_int(1, 100);
    $step = random_int(2, 10);
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

function startGameProgression(): void {
    startGame('progression.php');
}