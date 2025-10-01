<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Rename
            $table->renameColumn('title', 'position');
            $table->text('description')->change(); // Optional: tidak perlu rename kalau tetap pakai nama itu
            
            // Add New Columns
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->string('detail_location')->nullable();
            $table->string('min_experience')->nullable();
            $table->timestamp('publish_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Reverse
            $table->renameColumn('position', 'title');
            $table->dropColumn([
                'company',
                'location',
                'detail_location',
                'min_experience',
                'publish_at'
            ]);
        });
    }
};
