<?php

class Authentication
{
  private StorageInterface $storage;
  private array $users;

  public function __construct(StorageInterface $storage)
  {
    $this->storage = $storage;

    $this->users = $this->storage->loadData(User::getModelName());
  }

  public function register(string $name, string $email, string $password)
  {
    $customer = new Customer();
    $customer->setName($name);
    $customer->setEmail($email);
    $customer->setPassword($password);

    $this->users[] = $customer;
    $this->saveUser();

    printf("Registration successful. You can now log in.\n\n");
  }

  public function login(string $email, string $password)
  {
    foreach ($this->users as $user) {
      if ($user->getEmail() === $email && $user->getPassword() === $password) {
        return $user;
      }
    }

    return null;
  }

  public function saveUser(): void
  {
    $this->storage->save(User::getModelName(), $this->users);
  }
}
