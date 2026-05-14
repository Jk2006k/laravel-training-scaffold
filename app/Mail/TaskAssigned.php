<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TaskAssigned extends Mailable
{
    public function __construct(public Task $task)
    {
        // TODO Day 11: receive the Task instance
        // Load necessary relationships for email rendering
        $this->task->load('project', 'assignee');
    }

    public function envelope(): Envelope
    {
        // TODO Day 11: set subject — "You've been assigned: {task title}"
        return new Envelope(
            to: $this->task->assignee->email,
            subject: "You've been assigned: {$this->task->title}"
        );
    }

    public function content(): Content
    {
        // TODO Day 11: pass $this->task to the email view
        return new Content(
            markdown: 'emails.task-assigned',
            with: ['task' => $this->task]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}