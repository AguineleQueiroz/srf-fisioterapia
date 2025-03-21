<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            return $this->validateCpf($value);
        });
    }

    protected function validateCpf(string $cpf): bool {
        $cpf = array_map('intval', str_split(str_replace(['.', '-'], '', $cpf)));

        if (count($cpf) != 11 || count(array_unique($cpf)) === 1) {
            return false;
        }
        return $this->checkDigits($cpf);
    }

    public function checkDigits($cpf): bool
    {
        $result = function($limit) use ($cpf) {
            $sum = 0;
            for ($i = 0; $i < $limit; $i++) {
                $sum += $cpf[$i] * ($limit + 1 - $i);
            }
            $rest = $sum % 11;
            return $rest < 2 ? 0 : 11 - $rest;
        };

        return $cpf[9] === $result(9, 9) &&
            $cpf[10] === $result(10, 10);
    }
}
