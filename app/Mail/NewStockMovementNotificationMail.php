<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewStockMovementNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $stockMovement;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $stockMovement)
    {
        $this->stockMovement = $stockMovement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nova movimentação de estoque')
            ->from('almoxarifado-naoresponder@email.com')
            ->subject('Nova movimentação de estoque')
            ->view('emails.new-stock-movement')
            ->with([
                'materialName' => $this->stockMovement['material_name'],
                'type' => $this->stockMovement['type'],
                'quantity' => $this->stockMovement['quantity'],
                'date' => $this->stockMovement['date'],
                'collaboratorName' => $this->stockMovement['collaborator_name']
            ]);
    }

}
