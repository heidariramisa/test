<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $status_id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Status $status
 * @property User $user
 * @property Task[] $tasks
 */
class Todo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['status_id', 'user_id', 'title', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
