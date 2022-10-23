<?php

namespace App\Traits\Models;

Use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function(Model $model) {
            $slugSource = self::slugFrom();
            $model->slug = $model->slug ?? str($model->$slugSource)
                                                ->append(self::uniqueSlug($model))
                                                ->slug;
        });
    }

    /**
     * Определяет на основе какого аттрибута модели будет создаваться slug
     *
     * @return string
     */
    public static function slugFrom(): string
    {
        return 'title';
    }

    // TODO
    private static function uniqueSlug(Model $model): string
    {
        $alreadyExistsSlugsCount = $model::query()
            ->select('title')
            ->where('title', '=' . $model->title)
            ->count();

        if ($alreadyExistsSlugsCount == 0) {
            return '';
        }

        return (string) ($alreadyExistsSlugsCount + 1);
    }
}
