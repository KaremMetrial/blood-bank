<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Contact extends Model
    {

        use HasFactory;

        protected $table = 'contacts';
        public $timestamps = true;
        protected $fillable = array('client_id', 'subject', 'message');

        protected $with = ['client'];

        public function client()
        {
            return $this->belongsTo('App\Models\Client');
        }

    }
