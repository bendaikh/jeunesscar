<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddMissingColumns extends Migration
{
    public function up()
    {
        // Add deleted_at column to contracts table
        Schema::table('contracts', function (Blueprint $table) {
            if (!Schema::hasColumn('contracts', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Add language setting if it doesn't exist
        if (Schema::hasTable('settings')) {
            $exists = DB::table('settings')
                ->where('name', 'language')
                ->exists();

            if (!$exists) {
                DB::table('settings')->insert([
                    'name' => 'language',
                    'value' => 'English-en',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    public function down()
    {
        // Remove deleted_at column from contracts table
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Remove language setting
        if (Schema::hasTable('settings')) {
            DB::table('settings')
                ->where('name', 'language')
                ->delete();
        }
    }
} 