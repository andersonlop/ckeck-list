<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TarefaPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Tarefa $tarefa)
    {
        return $user->id === $tarefa->user_id;
    }

    public function update(User $user, Tarefa $tarefa)
    {
        return $user->id === $tarefa->user_id;
    }

    public function delete(User $user, Tarefa $tarefa)
    {
        return $user->id === $tarefa->user_id;
    }
}