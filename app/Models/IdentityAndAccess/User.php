<?php

namespace App\Models\IdentityAndAccess;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\IdentityAndAccess\Events\UserRegistered;
use App\Shared\Models\Events\EventRecording;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/** @property string $fullName */
/** @property EmailAddress $email */
/** @property string $password */

/** @property UserStatus $status */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use EventRecording;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
//        'password' => 'hashed',
    ];

    public static function register(string $fullName, EmailAddress $emailAddress, string $password): User
    {
        $user = new User();
        $user->full_name = $fullName;
        $user->email = $emailAddress->value();
        $user->password = $password;
        $user->status = UserStatus::Active;

        $user->recordEvent(new UserRegistered($user));

        return $user;
    }
}
