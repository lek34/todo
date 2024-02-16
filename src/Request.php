<?php

namespace Uph22si1Web\Todo;

// Request merupakan abstraksi terhadap object request dari user
// object ini akan digunakan oleh router dan controller untuk
// melakukan logic-nya
// contoh router akan menggunakan uri dan method untuk mencari
// handler/controller yang akan dikembalikan
// sedangkan controller akan menerima input berupa object request
// yang menampung seluruh informasi request
class Request {
  private string $uri;
  private string $method;
  private array $allRequestVariables;
  private array $queryRequestVariables;
  private array $cookieRequestVariables;

  function __construct(
    string $uri,
    string $method,
    array $allRequestVariables,
    array $queryRequestVariables,
    array $cookieRequestVariables
  ) {
    $this->uri = $uri;
    $this->method = $method;
    $this->allRequestVariables = $allRequestVariables;
    $this->queryRequestVariables = $queryRequestVariables;
    $this->cookieRequestVariables = $cookieRequestVariables;
  }

  public function getUri(): string {
    return $this->uri;
  }

  public function getMethod(): string {
    return $this->method;
  }

  public function input(?string $key): mixed {
    if (!$key) {
      return $this->allRequestVariables;
    }

    return $this->allRequestVariables[$key] ?? null;
  }

  public function query(?string $key): mixed {
    if (!$key) {
      return $this->queryRequestVariables;
    }

    return $this->queryRequestVariables[$key] ?? null;
  }

  public function cookie(?string $key): mixed {
    if (!$key) {
      return $this->cookieRequestVariables;
    }

    return $this->cookieRequestVariables[$key] ?? null;
  }
}
