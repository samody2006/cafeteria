<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone_primary');
            $table->string('phone_secondary')->nullable();
            $table->string('address')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->timestamps();
        });

        DB::table('contact_infos')->insert([
            'email' => 'Eastheromoh@gmail.com',
            'phone_primary' => '07083415288',
            'phone_secondary' => '08052113225',
            'address' => 'God\'s Own Cafeteria, Nigeria',
            'instagram_url' => null,
            'facebook_url' => null,
            'twitter_url' => null,
            'tiktok_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
