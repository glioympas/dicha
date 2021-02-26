<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $created;
    private $company;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($company, $created = false)
    {
        $this->company = $company;
        $this->created = $created;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject =  __("Company") . " " . $this->company->name . " " . ( $this->created ? __("has been created") : __("has been updated") );

        return (new MailMessage)->subject($subject)->markdown('mails.company_update', [
            'created' => $this->created,
            'company' => $this->company
        ]);
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
            //
        ];
    }
}
