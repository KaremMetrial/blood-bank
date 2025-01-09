<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class BloodType extends Model
    {
        use HasFactory;

        protected $table = 'blood_types';
        public $timestamps = true;
        protected $fillable = array('name');

        public function clients()
        {
            return $this->belongsToMany('App\Models\Client');
        }

        public function donationRequests()
        {
            return $this->hasMany('App\Models\DonationRequest');
        }

    }
