<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function welcomeUser(): void
{
    // Вывод приветствия
    line('Welcome to the Brain Games!');

    // Запрос имени у пользователя
    $name = prompt('May I have your name?');

    // Вывод приветствия с использованием введенного имени
    line("Hello, %s!", $name);
}
