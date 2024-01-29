<?php

namespace BrainGames\Cli;

require_once 'vendor/autoload.php';

use function cli\line;
use function cli\prompt;
// phpcs:disable
// Объявление символов (функций)
function welcomeUser()
{
    // Вызываем функцию с побочными эффектами
    performWelcomeUser();
}

// Логика с побочными эффектами
function performWelcomeUser()
{
    // Вывод приветствия
    line('Welcome to the Brain Game!');

    // Запрос имени у пользователя
    $name = prompt('May I have your name?');

    // Вывод приветствия с использованием введенного имени
    line("Hello, %s!", $name);
}
