<?php
namespace App\Mail;

use App\Models\Videogame;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewVideogameNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $videogame;

    /**
     * Create a new message instance.
     *
     * @param Videogame $videogame
     */
    public function __construct(Videogame $videogame)
    {
        $this->videogame = $videogame;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return (new Envelope())
            ->subject('Nuevo Videojuego Creado');
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return (new Content())
            ->view('emails.new-videogame') // La vista que se usará para el correo
            ->with([
                'name' => $this->videogame->name,
                'description' => $this->videogame->description,
                'user_name' => $this->videogame->user->name,
                'cover' => $this->videogame->cover,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
