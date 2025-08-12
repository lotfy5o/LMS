<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SmtpSettings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smtpSettings = [
            'mailer' => 'smtp',
            'host' => 'sandbox.smtp.mailtrap.io',
            'port' => 587,
            'username' => 'admin',
            'password' => Hash::make('111'),
            'encryption' => 'null',
            'from_address' => 'test@lms.com'
        ];

        DB::table('smtp_settings')->insert($smtpSettings);
    }
}
