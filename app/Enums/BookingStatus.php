<?php

namespace App\Enums;

trait EnumToArray
{

  public static function names(): array
  {
    return array_column(self::cases(), 'name');
  }

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }

  public static function array(): array
  {
    return array_combine(self::values(), self::names());
  }

}
enum BookingStatus: string {

    use EnumToArray;
    
    case A = "Aprovado";
    case C = "Cancelado";
    case P = "Pendente";
    case F = "Finalizado";
    case E = "Encerrado";
    case N = "Negado";

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