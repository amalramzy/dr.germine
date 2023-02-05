<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AllSalePersonNotification extends Notification
{
    use Queueable;
    private $salePerson;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($salePerson)
    {
        $this->salePerson = $salePerson;
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
    public function toDatabase($notifiable)
    {
        return 
                 [
                    'id'=> $this->salePerson->id,
                    'type' => 'general',
                    'title' => $this->salePerson->title,
                    'description' => $this->salePerson->description
                   
          
                 ];
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
