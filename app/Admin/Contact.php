<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public static function contact()
    {
        $contact = Contact::first();
        return $contact;
    }
}
