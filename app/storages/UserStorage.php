<?php

namespace app\storages;

use app\entities\User;
use easy\db\ORM\Entity;
use easy\db\Storage;

class UserStorage extends Storage
{
    /**
     * @param string $email
     * @param string $passwordHash
     * @return Entity|null
     * @throws \Exception
     */
    public function authenticate(string $email, string $passwordHash): ?User
    {
        return $this->createQueryBuilder()
            ->where('`email` = :email AND `password` = :passwordHash')
            ->param(':email', $email)
            ->param(':passwordHash', $passwordHash)
            ->getQuery()
            ->getResult()
            ?->asEntity();
    }

    /**
     * @param string $email
     * @return bool|null
     */
    public function emailExists(string $email): ?bool
    {
        return $this->createQueryBuilder()
            ->where('`email` = :email')
            ->param(':email', $email)
            ->getQuery()
            ->getResult()
            ?->exists();

    }

    /**
     * @param string $email
     * @param string $recovery
     * @return void
     */
    public function insertRecovery(string $email, string $recovery): void
    {
        $this->createUpgradeBuilder()
            ->set('`recovery` = :recovery')
            ->where('`email` = :email')
            ->param(':recovery', $recovery)
            ->param(':email', $email)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $code
     * @param string $passwordHash
     * @return void
     */
    public function updatePassword(string $code, string $passwordHash): void
    {
        $this->createUpgradeBuilder()
            ->set('recovery = "", password = :password ')
            ->where('recovery = :code')
            ->param(':code', $code)
            ->param(':password', $passwordHash)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $username
     * @return bool|null
     */
    public function usernameExists(string $username): ?bool
    {
        return $this->createQueryBuilder()
            ->where('`username` = :username')
            ->param(':username', $username)
            ->getQuery()
            ->getResult()
            ?->exists();
    }

    /**
     * @param string $registerCode
     * @return void
     */
    public function activateUser(string $registerCode): void
    {
        $this->createUpgradeBuilder()
            ->set('is_verified = TRUE, `register` = NULL')
            ->where('`register` = :register')
            ->param(':register', $registerCode)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $userId
     * @param bool $isVerified
     * @return void
     */
    public function changeIsVerified(int $userId, bool $isVerified): void
    {
        $this->createUpgradeBuilder()
            ->set('`is_verified` = :is_verified')
            ->where('`user_id` = :user_id')
            ->param(':is_verified', $isVerified)
            ->param(':user_id', $userId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @param int|string $groupId
     * @param int $isVerified
     * @return void
     */
    public function updateUser(int $id, int|string $groupId, int $isVerified) {
        $this->createUpgradeBuilder()
            ->set('`is_verified` = :is_verified, `group_id` = :group_id')
            ->where('`id` = :id')
            ->param(':id', $id)
            ->param(':is_verified', $isVerified)
            ->param(':group_id', !empty($groupId) ? $groupId : null)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $groupId
     * @return void
     */
    public function groupSetNull(int $groupId): void
    {
        $this->createUpgradeBuilder()
            ->set('group_id = NULL')
            ->where('group_id = :group_id')
            ->param(':group_id', $groupId)
            ->getQuery()
            ->getResult();
    }
}
