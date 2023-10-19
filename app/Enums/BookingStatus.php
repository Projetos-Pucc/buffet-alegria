<?php

namespace App\Enums;

enum SupportStatus: string {
    case A = "Aprovado";
    case P = "Pendente";
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
}