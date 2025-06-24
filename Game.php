<?php

global $argc, $argv;
const JSON_FILE = __DIR__ . "/stats.json";

if ($argc < 2)
{
    echo "👋 Welcome to the Number Guessing Game!\n";
    echo "🤔 I`m thinking of a number between 1 and 100.\n";
    echo "✅ You have 5 chances to guess the correct number.\n";
    echo "\n";

    $continue = true;

    while ($continue === true)
    {
        echo "🔥 Please select the difficulty level:\n";
        echo "1. Easy (10 chances)\n";
        echo "2. Medium (5 chances)\n";
        echo "3. Hard (3 chances)\n";
        echo "\n";
        echo "Enter your choice: ";
        $choice = trim(fgets(STDIN));
        
        $levels = [
                1 => "Easy",
                2 => "Medium",
                3 => "Hard",
        ];
    
        if (isset($levels[$choice])) {
        echo "🚀 Great! You have selected the $levels[$choice] difficulty level.\n";

        getTopStat($levels[$choice]);

        } else {
            echo "❌ Invalid Level.";
            exit;
        }

        echo "🎮 Let`s start the game!\n";
        game($choice);

        echo "\n👾 Do you want to play again?: \n";
        echo "1. Yes\n";
        echo "2. No\n";
        $continue = trim(fgets(STDIN));
        echo "\n";

        if ($continue === "1")
        {
            $continue = true;
        } else if ($continue === "2")
        {
            $continue = false;
        }
    }
}

function game(int $difficulty)
{
    $random = rand(0, 100);

    $levels = [
        1 => 10,
        2 => 5,
        3 => 3,
    ];

    $totalAttemps = $levels[$difficulty];

    $attemps = 0;
    $correct = false;
    $hint = false;
    $timer = startTimer();
    while ($attemps < $totalAttemps)
    {
        echo "🔎 Enter your guess: ";
        $guess = trim(fgets(STDIN));

        if ($guess < $random)
        {
            echo "❌ Incorrect! The number is greater than $guess.\n";
            echo "\n";
            $attemps++;
        } else if ($guess > $random)
        {
            echo "❌ Incorrect! The number is less than $guess.\n";
            echo "\n";   
            $attemps++;
        } else if ($guess == $random)
        {
            $ms = stopTimer($timer);
            $seconds = $ms / 1000;
            $duration = round($seconds, 3);
            $attemps++;
            echo "✅ Congratulations! You guessed the correct number in $attemps attemps and $duration s\n";
            echo "❓What is your Name? ";
            $name = trim(fgets(STDIN));
            saveStat($name, $attemps, $duration, $difficulty);



            echo "\n";
            $correct = true;
            break;   
        }
        
        if($hint == false){
            echo "🔎 Do you want a clue? \n";
            echo "1. Yes\n";
            echo "2. No\n";
            $clue = trim(fgets(STDIN));

            if($clue == "1"){
                givemeaHint($random);
                $hint = true;
            }
        }
    }

    if ($attemps >= $totalAttemps && $correct == false)
    {
        echo "❌ You have not managed to guess the number in the $totalAttemps attempts established.\n";
    }
}

function startTimer(): float {
    return microtime(true);
}

function stopTimer(float $start): float {
    $end = microtime(true);
    return ($end - $start) * 1000;
}

function givemeaHint(int $number){
    
    $array = [
        'oneAndAnother',
        'evenOrOdd',
        'secretNumber'
    ]; 
    
    $random = rand(0, count($array) - 1);

    $hintFunction = $array[$random];
    $hintFunction($number);
}

function oneAndAnother(int $number)
{
    if ($number >= 0 && $number <= 10){
        echo "👀 The number is between 0 and 10.\n";
    } else if ($number >= 10 && $number <= 20){
        echo "👀 The number is between 10 and 20.\n";
    } else if ($number >= 20 && $number <= 30){
        echo "👀 The number is between 20 and 30.\n";
    } else if ($number >= 30 && $number <= 40){
        echo "👀 The number is between 30 and 40.\n";
    } else if ($number >= 40 && $number <= 50){
        echo "👀 The number is between 40 and 50.\n";
    } else if ($number >= 50 && $number <= 60){
        echo "👀 The number is between 50 and 60.\n";
    } else if ($number >= 60 && $number <= 70){
        echo "👀 The number is between 60 and 70.\n";
    } else if ($number >= 70 && $number <= 80){
        echo "👀 The number is between 70 and 80.\n";
    } else if ($number >= 80 && $number <= 90){
        echo "👀 The number is between 80 and 90.\n";
    } else if ($number >= 90 && $number <= 100){
        echo "👀 The number is between 90 and 100.\n";
    }
}

function evenOrOdd(int $number){
    if($number % 2 == 0){
        echo "👀 The number is even.\n";
    } else if ($number % 2 != 0){
        echo "👀 The number is odd.\n";
    }
}

function secretNumber(int $number)
{
    $numberString = (string) $number;
    
    if(strlen($numberString) == 1){
        echo "👀 The number just have one digit.\n";
    } else if (strlen($numberString) > 1){
        $digit = $numberString[0];
        echo "👀 The first character of number is $digit.\n";
    }
}

function loader()
{
    if (!file_exists(JSON_FILE)) return [];
    $content = file_get_contents(JSON_FILE);
    $stats = json_decode($content, true);
    if (!is_array($stats)) return [];
    
    return $stats;
}

function save(array $stats)
{
    file_put_contents(JSON_FILE, json_encode($stats, JSON_PRETTY_PRINT));
}

function saveStat(string $name, int $attemps, float $time, int $difficulty)
{
    $stats = loader();
    if ($difficulty == 1){
        $difficulty = 'Easy';
    } else if ($difficulty == 2){
        $difficulty = 'Medium';
    } else if ($difficulty == 3){
        $difficulty = 'Hard';
    }

    $newStat = store($stats, $name, $attemps, $time, $difficulty);
    $stats[] = $newStat;
    save($stats);
}

function store(array $stats, string $name, int $attemps, float $time, string $difficulty)
{
    $date = date('Y-m-d');
    return [
        'name' => $name,
        'difficulty' => $difficulty,
        'attemps' => $attemps,
        'time' => $time,
        'date' => $date
    ];
}

function getTopStat(string $difficulty)
{
    $stats = loader();
    $best = null;

    foreach ($stats as $stat) {
        if ($stat['difficulty'] !== $difficulty) {
            continue; 
        }

        if ($best === null) {
            $best = $stat;
            continue;
        }

        if ($stat['attemps'] < $best['attemps']) {
            $best = $stat;
        } else if ($stat['attemps'] == $best['attemps']) {
            if ($stat['time'] < $best['time']) {
                $best = $stat;
            }
        }
    }

    if ($best === null) {
        echo "🏆 No stats yet for $difficulty.\n\n";
        return;
    }
    echo "🏆 Current best for $difficulty:\n";
    echo "   Player: {$best['name']}\n";
    echo "   Attempts: {$best['attemps']}\n";
    echo "   Time: {$best['time']} s\n";
    echo "   Date: {$best['date']}\n\n";
}

?>