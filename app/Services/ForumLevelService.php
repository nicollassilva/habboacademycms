<?php

namespace App\Services;

abstract class ForumLevelService
{
    public static function make(Int $count): Array
	{
		$level = "";

		if ($count <= 50) {
			$level = "level1";
			$next = 50;
		} else if ($count <= 100) {
			$level = "level2";
			$next = 100;
		} else if ($count <= 300) {
			$level = "level3";
			$next = 300;
		} else if ($count <= 600) {
			$level = "level4";
			$next = 600;
		} else if ($count <= 1000) {
			$level = "level5";
			$next = 1000;
		} else if ($count <= 1700) {
			$level = "level6";
			$next = 1700;
		} else if ($count >= 2500) {
			$level = "level7";
			$next = 10000;
		}

		return [
            "level" => $level,
            "next" => $next
        ];
	}
}
