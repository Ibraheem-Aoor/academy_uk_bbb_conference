<?php

namespace App\Enums;

enum PlanTypeEnum: string
{
    case DAILY = 'Daily';
    case WEEKLY = 'Weekly';
    case MONTHLY = 'Monthly';
    case ANNUALY = 'Annualy';

}
