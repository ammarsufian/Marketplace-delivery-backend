<?php

namespace App\Domains\ApplicationManagement\Listeners;

use App\Domains\ApplicationManagement\Events\SendClientAppNotification;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class SendClientAppNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @param SendClientAppNotification $event
     * @return void
     * @throws FirebaseException
     * @throws MessagingException
     */
    public function handle(SendClientAppNotification $event)
    {
        try {
            if (empty($event->getListeners())) {
                throw new Exception('FCM tokens is empty ');
            }

            $client = (new Factory)->createMessaging();
            $message = CloudMessage::fromArray([
                'notification' => [
                    'title' => $event->getTitle(),
                    'body' => $event->getBody(),
                ],
                'data' => $event->getData()
            ]);

            $client->sendMulticast($message, $event->getListeners());

        } catch (Exception $exception) {
            Log::error('send Notification error' . $exception->getMessage());
        }
    }
}
