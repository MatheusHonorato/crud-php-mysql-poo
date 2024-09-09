<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Enums\HttpStatusEnum;
use App\Http\RequestInterface;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepositoryPDO;

class UserController extends AbstractController
{
    public function __construct(
        private RequestInterface $request,
        private UserRepositoryInterface $userRepository = new UserRepositoryPDO()
    ) {
    }

    public function index(): void
    {
        $users = $this->userRepository->list();

        http_response_code(HttpStatusEnum::OK->value);

        $this->view('index', compact('users'));
    }

    public function show(int $id): void
    {
        $user = $this->userRepository->find($id);

        http_response_code(HttpStatusEnum::OK->value);

        $this->view('show', compact('user'));
    }

    public function create(): void
    {
        http_response_code(HttpStatusEnum::OK->value);

        $this->view('create');
    }

    public function store(): void
    {
        $user = new User(...$this->request::getBody());

        $this->userRepository->save($user);

        http_response_code(HttpStatusEnum::SEE_OTHER->value);

        $_SESSION['success'] = 'cadastro efetuado com sucesso!';

        header("Location: ".$this->request::getBaseUrl()."/users", true);
    }

    public function edit(int $id): void
    {
        $user = $this->userRepository->find($id);

        http_response_code(HttpStatusEnum::OK->value);

        $this->view('edit', compact('user'));
    }

    public function update(int $id): void
    {
        $user = new User(...[...$this->request::getBody(), 'id' => $id]);

        $this->userRepository->update($user);

        http_response_code(HttpStatusEnum::OK->value);

        $_SESSION['success'] = 'cadastro atualizado com sucesso!';

        header("Location: ".$this->request::getBaseUrl()."/users", true);
    }


    public function destroy(int $id): void
    {
        $this->userRepository->delete($id);

        http_response_code(HttpStatusEnum::NO_CONTENT->value);

        $_SESSION['success'] = 'cadastro excluído com sucesso!';

        header("Location: ".$this->request::getBaseUrl()."/users", true);
    }
}
