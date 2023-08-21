<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthdate',
        'group_id',
        'address',
        'surname',
        'patronymic',
        'password',
        'email',
        'role'
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
        'password' => 'hashed',
        'birthdate' => 'date',
        'address' => 'array',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('grade');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    protected function userColor(): Attribute
    {
        $min_grade = $this->subjects()->min('grade');
        return Attribute::make(
            get: fn () =>  $min_grade > 3 ? $min_grade > 4 ? 'table-success' : 'table-warning' : 'table-danger',
        );
    }

    protected function birthdate(): Attribute
    {
        return Attribute::make(
            get: fn ($date) => date('d-m-Y', strtotime($date)),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($name) => $this->name . ' ' . $this->surname . ' ' . $this->patronymic ,
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($name) => ucfirst($name),
        );
    }

    protected function surname(): Attribute
    {
        return Attribute::make(
            set: fn ($surname) => ucfirst($surname),
        );
    }

    protected function patronymic(): Attribute
    {
        return Attribute::make(
            set: fn ($patronymic) => ucfirst($patronymic),
        );
    }

    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->address['city'] . ' ' . $this->address['street'] . ' ' . $this->address['building']
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            set: function ($address) {
                $address['city'] = ucfirst($address['city']);
                $address['street'] = ucfirst($address['street']);

                return json_encode($address);
            }
        );
    }

    public function scopeFilter(Builder $query): void
    {
        if($name = request()->get('name'))
            $query->where(DB::raw("CONCAT(name, surname, patronymic)"), 'like', '%' . $name . '%');

        if($dateStart = request()->get('dateStart'))
            $query->where('birthdate', '>=', Carbon::parse($dateStart)->format('Y-m-d'));

        if($dateEnd = request()->get('dateEnd'))
            $query->where('birthdate', '>=',  Carbon::parse($dateEnd)->format('Y-m-d'));
    }

    protected function isAdmin():Attribute
    {
        return Attribute::make(
            get: fn() => $this->role === UserRole::Admin->value
        );
    }

    protected function isTeacher():Attribute
    {
        return Attribute::make(
            get: fn() => $this->role === UserRole::Teacher->value
        );
    }

    protected function isStudent():Attribute
    {
        return Attribute::make(
            get: fn() => $this->role === UserRole::Student->value
        );
    }
}
