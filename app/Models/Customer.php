<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Customer';
    protected $primaryKey = 'Customer_ID';
    public $timestamps = false;

    protected $fillable = ['Email', 'Password'];
    protected $hidden = ['Password'];

    // Laravel needs this to know where the password is
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Automatically hash passwords when set
    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'Customer_ID');
    }
    public function cartItemCount()
{
    return $this->cart ? $this->cart->products()->sum('Product_quantity') : 0;
}
}
