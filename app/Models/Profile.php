<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    use \App\Http\Traits\UsesUuid;

    protected $table = 'profiles';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'nik',
        'nama',
        'nohp',
        'rt',
        'kelurahan',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
