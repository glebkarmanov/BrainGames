#!/usr/bin/env php
<?php

namespace BrainGames\Games\Prime;

use function BrainGames\Engine\startGame;

function randomNumberForPrime(): int {
    return random_int(1, 100);
}

function checkPrime($number): bool {
    $i = 2;

    while ($i < $number) {
        if ($number % $i === 0) {
            return false;
        }
        $i += 1;
    }

    return true;
}

function startGamePrime(): void {
    startGame('prime');
}
