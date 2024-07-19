<?php

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;
// phpcs:disable
// Объявление символов (функций)
function welcomeUser(): void
{
    // Вызываем функцию с побочными эффектами
    performWelcomeUser();
}

// Логика с побочными эффектами
function performWelcomeUser(): void
{
    // Вывод приветствия
    line('Welcome to the Brain Games!');

    // Запрос имени у пользователя
    $name = prompt('May I have your name?');

    // Вывод приветствия с использованием введенного имени
    line("Hello, %s!", $name);
}
