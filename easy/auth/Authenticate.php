<?php

namespace easy\auth;

use app\controllers\auth\ActivateException;
use app\entities\User;
use app\storages\GroupStorage;
use app\storages\UserStorage;
use easy\http\Session;

class Authenticate
{
    public function __construct(
        private readonly UserStorage    $storage,
        private readonly GroupStorage   $groupStorage,
        private readonly Session        $session,
        private readonly PasswordHash   $passwordHash,
    )
    {
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     * @throws \Exception
     */
    public function login(string $email, string $password): bool
    {
        $passwordHash = $this->passwordHash->makeHash($password);
        $authenticate = $this->storage->authenticate($email, $passwordHash);

        if ($authenticate) {

            $authenticate->group = $this->groupStorage->load($authenticate->group_id)->asEntity();

            if (!$authenticate->is_verified) {
                throw new ActivateException('User isn\'t activated');
            }

            $this->session->set($this::class, $authenticate);
            return true;
        }
        return false;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->session->del($this::class);
    }

    /**
     * @return bool
     */
    public function isLogin(): bool
    {
        return $this->session->has($this::class);
    }

    /**
     * @return User|false
     */
    public function user(): User|false
    {
        if ($this->isLogin()) {
            return $this->session->get($this::class);
        }
        return false;
    }
}
