<?php

namespace App\Services;

class PingService
{
    /**
     * Realiza un ping a una dirección IP o host.
     *
     * @param string $host La dirección IP o host a la que se hará ping.
     * @param int $timeout El tiempo de espera en segundos.
     * @return bool Retorna true si el ping es exitoso, false en caso contrario.
     */
    public function ping($host, $timeout = 1)
    {
        $output = null;
        $status = null;

        // Ejecuta ping basado en el sistema operativo
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec("ping -n 1 -w " . ($timeout * 1000) . " {$host}", $output, $status);
        } else {
            exec("ping -c 1 -W {$timeout} {$host}", $output, $status);
        }

        return $status === 0;
    }
}