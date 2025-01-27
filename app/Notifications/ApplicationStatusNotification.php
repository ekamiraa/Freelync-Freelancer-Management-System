<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Application;

class ApplicationStatusNotification extends Notification
{
    use Queueable;

    public $application;

    public $statusMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Application $application, $statusMessage)
    {
        $this->application = $application;
        $this->statusMessage = $statusMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->application->project->title,
            'apply' => \Carbon\Carbon::parse($this->application->application_date)->format('d, m Y H:i'),
            'message' => $this->statusMessage
        ];
    }
}
