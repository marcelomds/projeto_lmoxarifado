<?php

namespace App\Mail;

use App\Models\Material\StockMovementFlow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewStockMovementNotification extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {

    }

    public function build()
    {
        return $this->view('emails.new_movement_stock')
            ->subject('Novo Movimento de Estoque');
    }
}
