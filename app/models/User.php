<?php
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    use SoftDeletes;
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
       'name', 'email', 'password','userimage'
   ];
   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   protected $hidden = [
       'password', 'remember_token',
   ];

 }