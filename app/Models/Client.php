<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class Client extends Authenticatable implements JWTSubject
    {
        use HasFactory;

        protected $table = 'clients';
        public $timestamps = true;
        protected $fillable = array('name', 'phone', 'email', 'password', 'd_o_b', 'blood_type_id', 'last_donation_date', 'city_id', 'pin_code','is_active');
        protected $hidden = array('password', 'remember_token');
        protected $casts = [
            'password' => 'hashed',
            'd_o_b' => 'date',
            'last_donation_date' => 'date',
            'is_active' => 'boolean',
        ];

        protected $with = ['city', 'bloodTypes'];


        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        public function getJWTCustomClaims()
        {
            return [];
        }

        public function bloodTypes()
        {
            return $this->belongsToMany(BloodType::class, 'blood_type_client', 'client_id', 'blood_type_id');
        }

        public function donationRequests()
        {
            return $this->hasMany('App\Models\DonationRequest');
        }

        public function contacts()
        {
            return $this->hasMany('App\Models\Contact');
        }

        public function governorates()
        {
            return $this->belongsToMany('App\Models\Governorate');
        }

        public function posts()
        {
            return $this->belongsToMany('App\Models\Post');
        }

        public function notifications()
        {
            return $this->belongsToMany('App\Models\Notification');
        }

        public function city()
        {
            return $this->belongsTo('App\Models\City');
        }

        public function tokens()
        {
            return $this->hasMany(Token::class);
        }

    }
