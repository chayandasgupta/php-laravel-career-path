<?php

class Authentication
{
  private StorageInterface $storage;
  private array $users;

  public function __construct(StorageInterface $storage)
  {
    $this->storage = $storage;
  }

  public function register(string $name, string $email, string $password)
  {
    $customer = new Customer();
    $customer->setName($name);
    $customer->setEmail($email);
    $customer->setPassword($password);

    $this->users[] = $customer;
    $this->saveUser();

    printf("Customer registered successfully\n\n");
  }

  public function login()
  {
  }

  public function saveUser(): void
  {
    $this->storage->save(User::getModelName(), $this->users);
  }
}
