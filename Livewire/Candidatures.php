<?php

namespace App\Livewire;

use App\Models\Candidature;
use Livewire\Component;

class Candidatures extends Component
{

    public $entreprise, $ville, $poste, $technologies, $remuneration;
    public $contact, $date_debut, $modalite_travail, $reference, $statut_candidature;
    public $candidatures;
    public $editingCandidature = false;
    public $confirmingDeletion = false;


    public $search = ''; // Ajout du champ de recherche

    public $sortField = 'entreprise';
    public $sortDirection = 'asc';


    public function mount()
    {
       $this->loadCandidatures();
    }

    public function store()
{
    $validatedData = $this->validate([
        'entreprise' => 'required|string',
        'ville' => 'required|string',
        'poste' => 'required|string',
        'technologies' => 'nullable|string',
        'remuneration' => 'required|string',
        'contact' => 'nullable|string',
        'date_debut' => 'nullable|date',
        'modalite_travail' => 'required|string',
        'reference' => 'nullable|string',
        'statut_candidature' => 'required|string',
    ]);

    Candidature::create($validatedData);

    $this->resetInputFields();
    $this->loadCandidatures();
    session()->flash('success', 'Candidature ajoutée avec succès.');
}


    public function updatedSearch()
    {
        $this->loadCandidatures();
    }
    

private function loadCandidatures()
    {
        $this->candidatures = Candidature::query()
        ->when($this->search, function ($query) {
            $query->where('entreprise', 'like', '%' . $this->search . '%')
                    ->orWhere('ville', 'like', '%' . $this->search . '%')
                    ->orWhere('poste', 'like', '%' . $this->search . '%')
                    ->orWhere('technologies', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();
    }
    // Sorting
    public function sortBy($field)
    {
      if ($this->sortField === $field) {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
      } else {
        $this->sortDirection = 'asc';
      }
      $this->sortField = $field;
      $this->loadCandidatures();
    }



    public function edit($id)
{
    try {
        $candidature = Candidature::findOrFail($id);
        $this->editingCandidature = $candidature;
        
        // Pré-remplir les champs avec les données existantes
        $this->entreprise = $candidature->entreprise;
        $this->ville = $candidature->ville;
        $this->poste = $candidature->poste;
        $this->technologies = $candidature->technologies;
        $this->remuneration = $candidature->remuneration;
        $this->contact = $candidature->contact;
        $this->date_debut = $candidature->date_debut;
        $this->modalite_travail = $candidature->modalite_travail;
        $this->reference = $candidature->reference;
        $this->statut_candidature = $candidature->statut_candidature;
        
    } catch (\Exception $e) {
        session()->flash('error', 'Candidature non trouvée.');
    }
}

public function updateCandidature()
{
    try {
        if ($this->editingCandidature) {
            $validatedData = $this->validate([
                'entreprise' => 'required|string',
                'ville' => 'required|string',
                'poste' => 'required|string',
                'technologies' => 'nullable|string',
                'remuneration' => 'required|string',
                'contact' => 'nullable|string',
                'date_debut' => 'nullable|date',
                'modalite_travail' => 'required|string',
                'reference' => 'nullable|string',
                'statut_candidature' => 'required|string',
            ]);

            // Mettre à jour les données
            $this->editingCandidature->update($validatedData);
            $this->candidatures = Candidature::all();
            $this->resetInputFields();
            $this->editingCandidature = false;
            session()->flash('success', 'Candidature mise à jour avec succès.');
        }
    } catch (\Exception $e) {
        session()->flash('error', 'Une erreur est survenue lors de la mise à jour de la candidature.');
    }
}
    
    
public function cancelEdit()
{
    $this->editingCandidature = false;
    $this->resetInputFields();
    $this->resetErrorBag();
    $this->resetValidation();
}

    public function delete($id)
    {
        $candidature = Candidature::find($id);

        if ($candidature) {
            $candidature->delete();
            $this->candidatures = Candidature::all();
            session()->flash('success', 'Candidature supprimée avec succès.');
        } else {
            session()->flash('error', 'Candidature non trouvée.');
        }
        $this->confirmingDeletion = false;
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletion = $id;
    }
    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
    }

    private function resetInputFields()
    {
        $this->entreprise = $this->ville = $this->poste = $this->technologies = null;
        $this->remuneration = $this->contact = $this->date_debut = null;
        $this->modalite_travail = $this->reference = $this->statut_candidature = null;
    }

    public function render()
    {
        return view('livewire.candidatures');
    }
}