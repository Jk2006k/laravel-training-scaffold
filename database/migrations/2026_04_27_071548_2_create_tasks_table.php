<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // TODO Day 4: add columns
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('todo');
            $table->date('due_date')->nullable();
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreignId('assigned_to_id')->nullable()->references('id')->on('users')->onDelete('set null');
            // TODO Day 11: add 'attachment_path' column (string, nullable) for file uploads
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};