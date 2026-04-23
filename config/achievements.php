<?php
return [
    'tasks_10' => [
        'event' => 'task_closed',
        'title' => 'Работяга 💪',
        'check' => fn($user) =>
            $user->tasks()->where('status', 'completed')->count() >= 10,
    ],

    'movies_10' => [
        'event' => 'movie_added',
        'title' => 'Киноман 🎬',
        'check' => fn($user) =>
            $user->movies()->count() >= 10,
    ],

    'movies_50' => [
        'event' => 'movie_added',
        'title' => 'Мегакинчик 🍿',
        'check' => fn($user) =>
            $user->movies()->count() >= 50,
    ],

    'comments_20' => [
        'event' => 'comment_created',
        'title' => 'Болтун 🗣',
        'check' => fn($user) =>
            $user->comments()->count() >= 20,
    ],

];
