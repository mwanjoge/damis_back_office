<?php

namespace App\Traits;

trait Notifier
{
    public function notifyMember($member, $message)
    {
        // Logic to send notification to the member
        // This could be an email, SMS, or in-app notification
        // For example:
        // Mail::to($member->email)->send(new NotificationMail($message));
    }
    public function notifyEmployee($admin, $message)
    {
        // Logic to send notification to the admin
        // This could be an email, SMS, or in-app notification
        // For example:
        // Mail::to($admin->email)->send(new NotificationMail($message));
    }
}
