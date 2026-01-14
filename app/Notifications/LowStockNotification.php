<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LowStockNotification extends Notification
{
    use Queueable;

    protected $accesorio;

    public function __construct($accesorio)
    {
        $this->accesorio = $accesorio;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('⚠️ Alerta de Bajo Stock: ' . $this->accesorio->descripcion)
            ->greeting('Estimado Usuario,')
            ->line('Se ha detectado que el accesorio "' . $this->accesorio->descripcion . '" ha alcanzado un nivel de stock crítico.')
            ->line('**Cantidad actual:** ' . $this->accesorio->cantidad)
            ->line('**Cantidad mínima permitida:** ' . $this->accesorio->cantidad_minima)
            ->action('Ver Detalles del Accesorio', url('/accesorios/' . $this->accesorio->id))
            ->line('Le recomendamos realizar un nuevo pedido de este accesorio lo antes posible para evitar inconvenientes.')
            ->salutation('Saludos cordiales');
    }

    public function toArray($notifiable)
    {
        return [
            'accesorio_id' => $this->accesorio->id,
            'message' => 'El accesorio "' . $this->accesorio->descripcion . '" tiene un stock bajo. Cantidad actual: ' . $this->accesorio->cantidad . '.',
        ];
    }
}
