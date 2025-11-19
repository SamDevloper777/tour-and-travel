<?php

namespace App\Livewire\Admin\Tour;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TourPackage;

class TourPackageList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search'];

    public function delete($id)
    {
        $package = TourPackage::find($id);
        if ($package) {
            $package->delete();
            session()->flash('message', 'Tour package deleted.');
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = TourPackage::query();
        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%')
                  ->orWhere('slug', 'like', '%'.$this->search.'%');
        }

        $packages = $query->orderBy('id', 'desc')->paginate($this->perPage);

        $packages->load('categories');

        return view('livewire.admin.tour.tour-package-list', compact('packages'));
    }
}
