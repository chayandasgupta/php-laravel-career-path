<?php

declare(strict_types=1);
require_once '../app/ModelInterface.php';

class User implements ModelInterface
{
  private string $name;
  private string $email;
  private string $password;
  protected UserType $type;

  public static function getModelName(): string
  {
    return "users";
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): void
  {
    $this->password = $password;
  }
}
