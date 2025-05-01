<?php

namespace App\Livewire;

use App\Http\Requests\StoreEmbassyRequest;
use Livewire\Component;
use App\Models\Embassy;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\EmbassyController;

class EmbassiesTable extends Component
{
    public $embassies = [];

    public $editingId = null;
    public $name;
    public $type;
    public $is_active = 1;

    protected $listeners = ['refreshEmbassies' => '$refresh'];

    public function mount()
    {
        $this->loadEmbassies();
    }

    public function loadEmbassies()
    {
        $this->embassies = Embassy::all()->toArray();
    }

    public function openForm($id = null)
    {
        if ($id) {
            $embassy = Embassy::findOrFail($id);
            $this->editingId = $embassy->id;
            $this->name = $embassy->name;
            $this->type = $embassy->type;
            $this->is_active = $embassy->is_active;
        } else {
            $this->reset(['editingId', 'name', 'type', 'is_active']);
        }
    }

    public function save()
    {
        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'is_active' => $this->is_active,
        ];

         dd($data);

        $request2 = new StoreEmbassyRequest( $data);
        $embassyController = app(EmbassyController::class);
        $response = $embassyController->store($request2);
        dd($response);

        // $request = Request::create(
        //     '/fake',
        //     $this->editingId ? 'PUT' : 'POST',
        //     array_merge($data, ['id' => $this->editingId])
        // );

        // app()->call([EmbassyController::class, 'storeOrUpdate'], ['request' => $request]);

        $this->reset(['editingId', 'name', 'type', 'is_active']);
        $this->mount(); // reload list
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id)
    {
        app()->call([EmbassyController::class, 'destroy'], ['id' => $id]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.embassies-table',
    [
            'countries' => Country::all(),
            'embassies' => Embassy::all(),
        ]
    );
    }
}
