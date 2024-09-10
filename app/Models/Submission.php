<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\SubmissionSaved;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (Submission $submission) {
            SubmissionSaved::dispatch($submission);
        });
    }
}
