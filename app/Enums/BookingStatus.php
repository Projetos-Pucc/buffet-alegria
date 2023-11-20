<?php

namespace App\Enums;

enum BookingStatus: string {

    use EnumToArray;
    
    case N = "Negado";
    case P = "Pendente";
    case A = "Aprovado";
    case C = "Cancelado";
    case F = "Finalizado";
    case E = "Encerrado";

	// função que irá retornar o value de algum status
    public static function fromValue(string $name): string {
        foreach (self::cases() as $status) {
            if($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$status is not valid");
    }
    public static function getEnumByName(string $name): self {
        foreach (self::cases() as $status) {
            if($name === $status->name) {
                return $status;
            }
        }

        throw new \ValueError("$status is not valid");
    }
}