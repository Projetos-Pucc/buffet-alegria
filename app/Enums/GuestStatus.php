<?php

namespace App\Enums;


enum GuestStatus: string {

    use EnumToArray;

    case E = "Pendente";
    case C = "Confirmado";
    case B = "Bloqueado";
    case P = "Presente";

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