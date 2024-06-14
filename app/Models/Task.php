<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Task model representing a periodic task.
 *
 * @property int $id
 * @property int|null $task_group_id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $frequency
 * @property int $duration
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property bool $completed
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\taskGroup $taskGroup
 */
class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_group_id',
        'user_id',
        'name',
        'description',
        'frequency',
        'duration',
        'start_date',
        'due_date',
        'completed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'due_date' => 'datetime',
        'completed' => 'boolean',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the task group that the task belongs to.
     */
    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    /**
     * Capitalize the first letter of the Task Name.
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }


}
