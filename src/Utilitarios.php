<?php
namespace Microblog;

// Metodos Utilitarios
abstract class Utilitarios {

    // Metodo static com o parâmetro $dados do tipo array , bool ou objeto (PHP 7.4)
    public static function dump(array | bool | object $dados): void {
        echo '<pre>';
        var_dump($dados);
        echo '</pre>';
    }
}
