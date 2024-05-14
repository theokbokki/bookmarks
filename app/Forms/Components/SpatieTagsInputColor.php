<?php

namespace App\Forms\Components;

use Filament\Forms\Components\SpatieTagsInput;
use Illuminate\Database\Eloquent\Model;

class SpatieTagsInputColor extends SpatieTagsInput
{
    protected function syncTagsWithAnyType(?Model $record, array $state): void
    {
        parent::syncTagsWithAnyType($record, $state);

        // Your custom logic to assign colors to tags
        $colors = [
            'red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal',
            'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose',
        ];

        foreach ($record->tags as $tag) {
            if (!$tag->color) {
                $tag->color = $colors[array_rand($colors)];
                $tag->save();
            }
        }
    }
}
