<?php

namespace App\Livewire\Admin\Experience;


use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Experience;
use Illuminate\Support\Str;

class ExperinceList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;

    public $experienceId;
    public $name;
    public $slug;
    public $status = true;

    protected function rules()
    {
        $uniqueRule = $this->experienceId ? "unique:experiences,slug,{$this->experienceId}" : 'unique:experiences,slug';
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', $uniqueRule],
            'status' => 'boolean',
        ];
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = Experience::query();
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%");
        }
        $experiences = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.admin.experience.experince-list', [
            'experiences' => $experiences,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $exp = Experience::findOrFail($id);
        $this->experienceId = $exp->id;
        $this->name = $exp->name;
        $this->slug = $exp->slug;
        $this->status = (bool) $exp->status;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
        ];
        if ($this->experienceId) {
            Experience::findOrFail($this->experienceId)->update($data);
            session()->flash('message', 'Experience updated successfully.');
        } else {
            Experience::create($data);
            session()->flash('message', 'Experience created successfully.');
        }
        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->experienceId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->experienceId) {
            Experience::destroy($this->experienceId);
            session()->flash('message', 'Experience deleted.');
        }
        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->experienceId = null;
    }

    protected function resetForm()
    {
        $this->experienceId = null;
        $this->name = null;
        $this->slug = null;
        $this->status = true;
        $this->resetValidation();
    }
}
