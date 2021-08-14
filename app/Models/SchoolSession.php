<?php

namespace App\Models;

use App\Models\Term;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolSession extends Model
{
    use HasFactory;

    protected $fillable = ['session_name'];

    protected $hidden = ['updated_at'];

    // protected $casts = ["is_active" => "boolean"];

    public function terms()
    {
        return $this->hasMany(Term::class);
    }
}
