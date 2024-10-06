<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class SolicitarVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function solicitar()
    {
        $datos = $this->validate();

        // Valida que un reclutador no pueda solicitar un puesto que ha creado
        if (auth()->user()->id === $this->vacante->reclutador->id) {
            session()->flash('error', 'No puedes solicitar un puesto que tu mismo has publicado');

        // Valida que un solicitante no pueda volver a solicitar el mismo puesto
        } else if ($this->vacante->candidatos()->where('user_id', auth()->user()->id)->count() > 0) {
            session()->flash('error', 'Ya has solicitado este puesto anteriormente');
        } else {

            // Almacenar el cv
            $cv = $this->cv->store('public/cv');
            $datos['cv'] = str_replace('public/cv/', '', $cv);

            // Crear el candidato a la vacante
            $this->vacante->candidatos()->create([
                'user_id' => auth()->user()->id,
                'cv' => $datos['cv']
            ]);

            // Crear notificación y enviar email
            $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

            // Mostrar al usuario mensaje de email
            session()->flash('mensaje', 'La información se ha enviado correctamente. ¡Suerte!');
            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.solicitar-vacante');
    }
}
