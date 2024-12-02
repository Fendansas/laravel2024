<?php
namespace App\Models;

use Illuminate\Support\Arr;

class Group{
    public static function all(): array
    {
        return[
            [
                'id' => '1',
                'title' => 'director',
                'salary' => '100 0000',
            ],
            [
                'id' => '2',
                'title' => 'Programmer',
                'salary' => '10 000',
            ],
            [
                'id' => '3',
                'title' => 'Disigner',
                'salary' => '10 000',
            ]
        ];
    }

    public static function find(int $id): array
    {
        $group = Arr::first(static::all(), fn ($group) => $group['id'] == $id);

        if (! $group){
            abort(404);
        }
        return $group;
    }
}
