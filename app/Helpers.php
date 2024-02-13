<?php

    if (!function_exists('id_youtube')) {
        function id_youtube($url) {
            $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
            $array = preg_match($patron, $url, $parte);
            if (false !== $array) {
                return $parte[1];
            }
            return false;
        }
    }