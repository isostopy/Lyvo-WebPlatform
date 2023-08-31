<?php

    //*******************************************************************
    // PHP para la gestión de errores.
    //*******************************************************************

    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.
    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.
    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.
    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.
    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.
    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.
    // ESTA CLASE NO SE UTILIZA PERO ESTÁ GUARDADA COMO REFERENCIA.

    class ErrorMessages {
        
        private $errors = [

            'ERR_LOGIN_1' => 'Se ha producido un error.',
            'ERR_REG_1' => 'Se ha producido un error.',
            
        ];
    
        public function getErrorMessage($code) 
        {
            if (array_key_exists($code, $this->errors)) 
            {
                return $this->errors[$code];
            }
            return 'Error desconocido.';
        }
    }
?>