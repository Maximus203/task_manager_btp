<?php
// src/Entity/Status.php
namespace App\Entity;

use Symfony\Component\TypeInfo\Type\EnumType;

class Status extends EnumType
{
    public const INITIAL = 'initial';
    public const EN_COURS = 'en cours';
    public const EN_COURS_HD = 'en cours hors délai';
    public const TERMINEE_DD = 'terminé dans les délai';
    public const TERMINEE_HD = 'terminé hors délais';
    public const REJETE = 'rejeté';
}
