<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;

class ErrorNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->headerBlock('🚨 System Alert')
            ->sectionBlock(function ($block) {
                $block->text('Your Laravel 12 project is successfully connected to Slack.');
            })
            ->dividerBlock()
            ->contextBlock(function ($block) {
                $block->text('Sent from JustRepair Backend');
            });
    }

}
