<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre','email','password','apellido1','apellido2','email','contacto1','contacto2','nacimiento','rol','estado'];

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','max:255'],
            'apellido1' => ['required', 'string', 'max:50'],
            'apellido2' => ['nullable','string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clientes'],
            'password' => ['required', 'string','max:16', 'confirmed'],
            'contacto1' => ['required', 'string', 'max:12'],
            'contacto2' => ['nullable','string', 'max:12'],
        ]);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
