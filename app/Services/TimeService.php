<?php

namespace App\Services;

use Carbon\Carbon;

abstract class TimeService
{
    public static function transform($date): String
    {
		$restTime = now()->timestamp - $date->timestamp;

		if ($restTime < 1) {
			return '1 segundo';
        }

        $timeFormat = array(
            365 * 24 * 60 * 60  =>  'ano',
            30 * 24 * 60 * 60  =>  'mês',
            24 * 60 * 60  =>  'dia',
            60 * 60  =>  'hora',
            60  =>  'minuto',
            1  =>  'segundo'
        );

        $pluralTime = array(
            'ano'   => 'anos',
            'mês'  => 'meses',
            'dia'    => 'dias',
            'hora'   => 'horas',
            'minuto' => 'minutos',
            'segundo' => 'segundos'
        );

        foreach ($timeFormat as $seconds => $relatedTime) {
            $d = $restTime / $seconds;
            if ($d >= 1) {
                $time = round($d);
                return "há {$time} " . ($time > 1 ? $pluralTime[$relatedTime] : $relatedTime) . ' atrás';
            }
        }
    }
}
