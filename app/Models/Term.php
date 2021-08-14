<?php

namespace App\Models;

use App\Models\SchoolSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'term_name'];

    protected $hidden = ['updated_at'];

    public function session()
    {
        return $this->belongsTo(SchoolSession::class);
    }
}
