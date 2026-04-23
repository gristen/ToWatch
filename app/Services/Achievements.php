<?php

namespace App\Services;

class Achievements
{
    public function check($user, $event): void
    {
        $achievements = config('achievements');


        foreach ($achievements as $key => $achievement) {

            if ($achievement['event'] !== $event) {
                continue; //следующая итерация цикла
            }

            if ($achievement['check']($user)) { // в check ключе лежит стрелочная(анонимная)функция и вызывается через ()
                $this->unlock($user, $key, $achievement);
            }
        }
    }
    protected function unlock($user,$key, $data): void
    {
        // ищем ачивку в БД
        $achievement = Achievement::where('key', $key)->first();

        if (!$achievement) {
            return; // защита
        }

        // уже есть?
        if ($user->achievements()->where('achievement_id', $achievement->id)->exists()) {
            return;
        }
        $user->achievements()->attach($achievement->id);

    }
}
