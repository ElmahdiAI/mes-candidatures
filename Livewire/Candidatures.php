<?php

namespace App\Livewire;

use App\Models\Candidature;
use Livewire\Component;

class Candidatures extends Component
{
    // Déclaration des propriétés publiques
    public $entreprise, $ville, $poste, $technologies, $remuneration;
    public $contact, $date_debut, $modalite_travail, $reference, $statut_candidature;
    public $candidatures, $editingCandidature = false, $confirmingDeletion = false, $préembauche = false;
    public $search = '', $sortField = 'entreprise', $sortDirection = 'asc';

    /**
     * Initialisation du composant.
     */
    public function mount()
    {
        $this->loadCandidatures();
    }

    /**
     * Validation des données.
     */
    private function validateCandidature()
    {
        return $this->validate([
            'entreprise' => 'required|string',
            'ville' => 'required|string',
            'poste' => 'required|string',
            'technologies' => 'nullable|string',
            'remuneration' => 'required|string',
            'préembauche' => 'required|boolean',
            'contact' => 'nullable|string',
            'date_debut' => 'nullable|date',
            'modalite_travail' => 'required|string',
            'reference' => 'nullable|string',
            'statut_candidature' => 'required|string',
        ]);
    }

    /**
     * Charger les candidatures avec tri et recherche.
     */
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

    /**
     * Ajouter une nouvelle candidature.
     */
    public function store()
    {
        Candidature::create($this->validateCandidature());
        $this->resetInputFields();
        $this->loadCandidatures();
        session()->flash('success', 'Candidature ajoutée avec succès.');
    }

    /**
     * Mettre à jour la liste des candidatures lors de la recherche.
     */
    public function updatedSearch()
    {
        $this->loadCandidatures();
    }

    /**
     * Gestion du tri par colonne.
     */
    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortField = $field;
        $this->loadCandidatures();
    }

    /**
     * Préparer la modification d'une candidature.
     */
    public function edit($id)
    {
        $candidature = Candidature::findOrFail($id);
        $this->editingCandidature = $candidature;
        $this->fill($candidature->toArray());
    }

    /**
     * Mettre à jour une candidature.
     */
    public function updateCandidature()
    {
        if ($this->editingCandidature) {
            $this->editingCandidature->update($this->validateCandidature());
            $this->resetEditing();
            session()->flash('success', 'Candidature mise à jour avec succès.');
            $this->loadCandidatures();
        }
    }

    /**
     * Réinitialiser le formulaire d'édition.
     */
    public function resetEditing()
    {
        $this->resetInputFields();
        $this->editingCandidature = false;
    }

    /**
     * Supprimer une candidature.
     */
    public function delete($id)
    {
        if ($candidature = Candidature::find($id)) {
            $candidature->delete();
            $this->loadCandidatures();
            session()->flash('success', 'Candidature supprimée avec succès.');
        } else {
            session()->flash('error', 'Candidature non trouvée.');
        }
        $this->confirmingDeletion = false;
    }

    /**
     * Confirmer ou annuler la suppression.
     */
    public function confirmDelete($id)
    {
        $this->confirmingDeletion = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
    }

    /**
     * Réinitialiser les champs du formulaire.
     */
    private function resetInputFields()
    {
        $this->reset([
            'entreprise', 'ville', 'poste', 'technologies',
            'remuneration', 'contact', 'date_debut', 'préembauche',
            'modalite_travail', 'reference', 'statut_candidature'
        ]);
    }

    /**
     * Afficher la vue.
     */
    public function render()
    {
        return view('livewire.candidatures');
    }
}
