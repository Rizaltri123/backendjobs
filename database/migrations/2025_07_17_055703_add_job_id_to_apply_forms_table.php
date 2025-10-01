<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('apply_forms', function (Blueprint $table) {
        $table->unsignedBigInteger('job_id')->nullable()->after('id');
        $table->foreign('job_id')->references('id')->on('job_listings')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('apply_forms', function (Blueprint $table) {
        $table->dropForeign(['job_id']);
        $table->dropColumn('job_id');
    });
}
};
