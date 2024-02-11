<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPasajeros;
use App\Models\MCentroCosto;

class CPasajeros extends BaseController
{
    public function index()
    {               
        $grupo = session('group_name');
        $id_user = session('id_user');

        $centros_costos = new MCentroCosto();
        $datos['centros_costos'] = $centros_costos->getCC();
        
        if($grupo == 'requisidor'){
            $pasajeros = new MPasajeros();
            $datos['pasajeros'] = $pasajeros->getPasajerosUser($id_user);
            //echo $id_user; exit();
        }else{
            $pasajeros = new MPasajeros();
            $datos['pasajeros'] = $pasajeros->getPasajeros();
        }

        return view('pasajeros/add',$datos);
    }

    public function dashboard()
    {
        return view('templates/pasajero_templates');
    }

    public function save(){
        $pasajeros = new MPasajeros();        
        $datos = $this->request->getVar();
        
        $datos['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $datos['correo'] = $_POST['email'];
        $datos['group'] = 4;
        $datos['id_user_registro'] = session('id_user');

        $datosPasajero = $pasajeros->getPasajero(['id_nacional'=>$datos['id_nacional']]);

        if(count($datosPasajero)>0){
            return redirect()->route('admin/Pasajeros')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Usuario ya registrado, cedula repetida'
                ]);
        }

        if(!$pasajeros->save($datos)){
            return redirect()->route('admin/Pasajeros')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route('admin/Pasajeros')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Guardado!'
                ]);
        }
    }

    public function edit($id = null){
        $pasajero = new MPasajeros();
        $datos['pasajero'] = $pasajero->where('id_pasajero',$id)->first();        
        return view('pasajeros/edit', $datos);  
    }

    public function update(){
        $pasajero = new MPasajeros();        
        $datos = $this->request->getVar();
        
        if($this->request->getVar('password')){
            $datos['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }else{
            $datos['password'] = $this->request->getVar('old_password');
        }
        $datos['group'] = 4;

        if(!$pasajero->update($datos['id_pasajero'],$datos)){
            return redirect()->route('admin/Pasajeros')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route('admin/Pasajeros')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }
    }

    public function delete($id = null){
        $pasajero = new MPasajeros(); 
        //$user->delete(['id'=>$id]);

        if($pasajero->delete(['id_pasajero'=>$id])){
            return redirect()->route('admin/Pasajeros')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Eliminado con exito!'
            ]);
        }else{
            return redirect()->route('admin/Pasajeros')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo eliminar'
            ]);

        }           
    }

    /*Start upload*/
    public function upload(){
        $db = \Config\Database::connect();
        //$builder = $db->table('t_pasajeros')->truncate();

        
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
              
        if($extension == 'csv'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }elseif($extension == 'xls'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else{
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $reader->setReadDataOnly(true);
        
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
        //echo "<h1>Datos que se cargaran</h1>";
        //dd($sheetData);

        $sheetcount = count($sheetData);
        $datos = [];
        if($sheetcount>1){
            for ($i=1; $i < $sheetcount; $i++) { 
                
                $id_nacional = $sheetData[$i][0];
                $region = $sheetData[$i][1];
                $pais = $sheetData[$i][2];
                $ciudad = $sheetData[$i][3];
                $organizacion = $sheetData[$i][4];
                $empresa = $sheetData[$i][5];
                $c_level = $sheetData[$i][6];
                $viseprescidente = $sheetData[$i][7];
                $direccion_general = $sheetData[$i][8];
                $direccion = $sheetData[$i][9];
                $gerencia = $sheetData[$i][10];
                $jefactura = $sheetData[$i][11];
                $area = $sheetData[$i][12];
                $centro_costo = $sheetData[$i][13];
                $nombre_centro_costo = $sheetData[$i][14];
                $codigo_empleado = $sheetData[$i][15];
                $user_sys = $sheetData[$i][16];
                $codigo_rps = $sheetData[$i][17];
                $id_nacional2 = $sheetData[$i][18];
                $tipo_documento = $sheetData[$i][19];
                $fecha_nacimiento = $sheetData[$i][20];
                $genero = $sheetData[$i][21];
                $primer_apellido = $sheetData[$i][22];
                $segundo_apellido = $sheetData[$i][23];
                $primer_nombre = $sheetData[$i][24];
                $segundo_nombre = $sheetData[$i][25];
                $nombre_completo = $sheetData[$i][26];
                $posicion = $sheetData[$i][27];
                $codigo_posicion = $sheetData[$i][28];
                $grupo_personal = $sheetData[$i][29];
                $area_personal = $sheetData[$i][30];
                $trabajo = $sheetData[$i][31];
                $auxilio_combustible = $sheetData[$i][32];
                $correo = $sheetData[$i][33];
                $direccion = $sheetData[$i][34];
                $barrio = $sheetData[$i][35];
                $celular = $sheetData[$i][36];
                $operacion = $sheetData[$i][37];
                $zona_ruta = $sheetData[$i][38];
                $habilitado = $sheetData[$i][39];
                
                $data = [
                    'id_cliente' => 1,
                    'id_nacional' => $id_nacional,
                    'region' => $region,
                    'pais' => $pais,
                    'ciudad' => $ciudad,
                    'organizacion' => $organizacion,
                    'empresa' => $empresa,
                    'c_level' => $c_level,
                    'viseprescidente' => $viseprescidente,
                    'direccion_general' => $direccion_general,
                    'direccion' => $direccion,
                    'gerencia' => $gerencia,
                    'jefactura' => $jefactura,
                    'area' => $area,
                    'centro_costo' => $centro_costo,
                    'nombre_centro_costo' => $nombre_centro_costo,
                    'codigo_empleado' => $codigo_empleado,
                    'user_sys' => $user_sys,
                    'codigo_rps' => $codigo_rps,
                    'tipo_documento' => $tipo_documento,
                    'fecha_nacimiento' => $fecha_nacimiento,
                    'genero' => $genero,
                    'primer_apellido' => $primer_apellido,
                    'segundo_apellido' => $segundo_apellido,
                    'primer_nombre' => $primer_nombre,
                    'segundo_nombre' => $segundo_nombre,
                    'nombre_completo' => $nombre_completo,
                    'posicion' => $posicion,
                    'codigo_posicion' => $codigo_posicion,
                    'grupo_personal' => $grupo_personal,
                    'area_personal' => $area_personal,
                    'trabajo' => $trabajo,
                    'auxilio_combustible' => $auxilio_combustible,
                    'correo' => $correo,
                    'direccion' => $direccion,
                    'barrio' => $barrio,
                    'celular' => $celular,
                    'operacion' => $operacion,
                    'zona_ruta' => $zona_ruta,
                    'habilitado' => $habilitado,
                    'group' => 5,
                    'password' => password_hash('pasajero123', PASSWORD_DEFAULT),    
                ];

                //dd($data);



                $cargarCC = new MPasajeros();
                $cargarCC->insert($data);
               

            }           
            
            return redirect()->route('admin/Pasajeros')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Pasajeros cargados.'
            ]);
            
        }

    }
    /*End upload*/

}
