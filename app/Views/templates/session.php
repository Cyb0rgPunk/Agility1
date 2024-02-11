<?php 

    if (session('group_name') == 'admin'){
        $this->extend('templates/admin_templates');
    }
    if (session('group_name') == 'coordinador'){
        $this->extend('templates/coordinador_templates');
    }
    if (session('group_name') == 'interventor'){
        $this->extend('templates/interventor_templates');
    }  
    if (session('group_name') == 'pasajero'){
        $this->extend('templates/pasajero_templates');
    }  
    if (session('group_name') == 'conductor'){
        $this->extend('templates/conductor_templates');
    }   
    if (session('group_name') == null){
        $this->extend('login');
    }
    if (session('group_name') == ''){
        $this->extend('login');
    }


?>