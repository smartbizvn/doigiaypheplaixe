<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('no', 255);
            $table->longText('epitome');
            $table->date('date_issue');
            $table->string('file', 255)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->unsignedBigInteger('class_document')->nullable();
            $table->unsignedBigInteger('agency_document')->nullable();
            $table->unsignedBigInteger('field_document')->nullable();
            $table->unsignedBigInteger('type_document')->nullable();
            $table->longText('desc')->nullable();
            $table->unsignedBigInteger('order')->default(999);
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
