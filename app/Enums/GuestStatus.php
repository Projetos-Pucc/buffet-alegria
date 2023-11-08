<?php

namespace App\Enums;

enum GuestStatus: string {
    case N = "Neutro";
    case P = "Presente";
    case A = "Ausente";

	// função que irá retornar o value de algum status
    public static function fromValue(string $name): string {
        foreach (self::cases() as $status) {
            if($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$status is not valid");
    }
}