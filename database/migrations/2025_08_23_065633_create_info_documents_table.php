<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('info_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->enum('type', ['class_document', 'agency_document', 'field_document','type_document']);
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('info_documents');
    }
};
