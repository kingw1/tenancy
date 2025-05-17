<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    public function causer(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    public function subject(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    protected function UserName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->causer->name ?? 'System';
            }
        );
    }

    protected function LogSubjectName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return class_basename($this->subject);
            }
        );
    }

    protected function subjectName(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (isset($this->subject->name)) {
                    return $this->subject->name;
                } else {
                    return $this->subject->log_name ?? '';
                }
            }
        );
    }

    protected function FullDescription(): Attribute
    {
        return Attribute::make(
            get: function () {
                $subject = $this->subject_name ? " <strong>:{$this->subject_name}</strong>" : '';
                return "{$this->user_name} {$this->description} {$this->log_subject_name}" . $subject;
            }
        );
    }
}
