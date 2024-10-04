<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
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

    public function mount(Vacante $vacante){
       $this->vacante = $vacante;
    }

    public function solicitar()
    {
        $datos = $this->validate();

        // Almacenar el cv
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        // Crear el candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        // Crear notificación y enviar email

        // Mostrar al usuario mensaje de email
        session()->flash('mensaje', 'La información se ha enviado correctamente. ¡Suerte!');
        return redirect()->back();


    }
    public function render()
    {
        return view('livewire.solicitar-vacante');
    }
}
