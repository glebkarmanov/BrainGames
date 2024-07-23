#!/usr/bin/env php
<?php

namespace BrainGames\Games\Even;

use function cli\line;
use function cli\prompt;
use function BrainGames\Engine\greetUser;
use function BrainGames\Engine\askQuestion;
use function BrainGames\Engine\isAnswerCorrect;
use function BrainGames\Engine\playGame;
use function BrainGames\Engine\announceResult;
use function BrainGames\Engine\startGame;

function generateRandomNumber(): int
{
    return random_int(1, 99);
}

function startGameEven(): void {
    startGame('even');
}