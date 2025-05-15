<?php

namespace App\Http\Livewire\Utils\Order;

use App\Domains\Auth\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserSelectComponent extends Component
{

    use WithPagination;

    public int $user_id = 0;
    public string $keyword = '';

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->keyword . '%')
            ->select('id', 'name', 'email')
            ->orWhere('email', 'like', '%' . $this->keyword . '%')
            ->paginate(10);

        return view('livewire.utils.order.user-select-component', [
            'users' => $users
        ]);
    }

    public function selectUser($user_id, $name)
    {
        $this->user_id = $user_id;
    }
}
