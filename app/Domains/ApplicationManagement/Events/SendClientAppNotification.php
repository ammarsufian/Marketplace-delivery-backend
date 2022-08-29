<?php

namespace App\Domains\ApplicationManagement\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendClientAppNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Model $model;
    protected string $title;
    protected string $body;

    public function __construct(Model $model, string $title, string $body)
    {
        $this->model = $model;
        $this->title = $title;
        $this->body = $body;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getData(): array
    {
        return [
            'model_id' => $this->model->id,
            'model_type' => class_basename($this->model)
        ];
    }

    public function getListeners(): ?array
    {
        return Auth::user()->tokens()->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
    }
}
