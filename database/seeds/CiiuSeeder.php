<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiiuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de cereales (excepto arroz), legumbres y semillas oleaginosas',
            'codigo' => '0111',
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de  arroz',
            'codigo' => '0112',
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de ortalizas, raíces y tubérculos',
            'codigo' => '0113'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de tabaco',
            'codigo' => '0114'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'Cultivo de plantas textiles',
            'codigo' => '0115'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACION DE OTROS ARTÍCULOS DE PAPEL Y CARTON',
            'codigo' => '1709'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACION DE PAPEL Y CARTON ONDULADO (CORRUGADO); FABRICACION DE ENVASES, EMPAQUES Y DE EMBALAJES DE PAPEL Y CARTON',
            'codigo' => '1702'
        ]);
        

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE CONSULTORÍA DE GESTIÓN',
            'codigo' => '7020'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'OTROS TIPOS DE EDUCACIÓN N.C.P.',
            'codigo' => '8559'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ALMACENAMIENTO Y DEPÓSITO',
            'codigo' => '5210'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'CULTIVO DE CAÑA DE AZÚCAR',
            'codigo' => '0124'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'COMERCIO AL POR MENOR DE CARNES (INCLUYE AVES DE CORRAL), PRODUCTOS CÁRNICOS, PESCADOS Y PRODUCTOS DE MAR, EN ESTABLECIMIENTOS ESPECIALIZADOS',
            'codigo' => '4723'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE LA PRÁCTICA MÉDICA, SIN INTERNACIÓN',
            'codigo' => '8621'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'INVESTIGACIONES Y DESARROLLO EXPERIMENTAL EN EL CAMPO DE LAS CIENCIAS NATURALES Y LA INGENIERÍA',
            'codigo' => '7210'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'COMERCIO AL POR MAYOR DE PRODUCTOS ALIMENTICIOS',
            'codigo' => '4631'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE PILAS, BATERÍAS Y ACUMULADORES ELÉCTRICOS',
            'codigo' => '2720'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE ARTÍCULOS DE PLÁSTICO N.C.P.',
            'codigo' => '2229'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE LA PRÁCTICA ODONTOLÓGICA',
            'codigo' => '8622'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'CONSTRUCCIÓN DE CARRETERAS Y VÍAS DE FERROCARRIL',
            'codigo' => '4210'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES JURÍDICAS',
            'codigo' => '6910'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE LLANTAS Y NEUMÁTICOS DE CAUCHO',
            'codigo' => '2211'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE CONTABILIDAD, TENEDURÍA DE LIBROS, AUDITORÍA FINANCIERA Y ASESORÍA TRIBUTARIA',
            'codigo' => '6920'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FIDEICOMISOS, FONDOS Y ENTIDADES FINANCIERAS SIMILARES',
            'codigo' => '6431'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE JABONES Y DETERGENTES, PREPARADOS PARA LIMPIAR Y PULIR; PERFUMES Y PREPARADOS DE TOCADOR',
            'codigo' => '2023'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE PARTES, PIEZAS (AUTOPARTES) Y ACCESORIOS (LUJOS) PARA VEHÍCULOS AUTOMOTORES',
            'codigo' => '2930'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE OTROS ARTÍCULOS TEXTILES N.C.P.',
            'codigo' => '1399'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ESTUDIOS DE MERCADO Y REALIZACION DE ENCUESTAS DE OPINION PUBLICA',
            'codigo' => '7320'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'CRIA DE GANADO BOVINO Y BUFALINO',
            'codigo' => '0141'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'CRIA DE GANADO PORCINO',
            'codigo' => '0144'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE ADMINISTRACIÓN EMPRESARIAL',
            'codigo' => '7010'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'OTRAS ACTIVIDADES DE ATENCION DE LA SALUD HUMANA',
            'codigo' => '8699'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ALQUILER Y ARRENDAMIENTO DE OTROS TIPOS DE MAQUINARIA, EQUIPO Y BIENES TANGIBLES N.C.P.',
            'codigo' => '7730'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'INVESTIGACION Y DESARROLLO EXPERIMENTAL EN EL CAMPO DE LAS CIENCIAS NATURALES Y LA INGENIERIA',
            'codigo' => '7210'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES INMOBILIARIAS REALIZADAS CON BIENES PROPIOS O ARRENDADOS',
            'codigo' => '6810'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'COMERCIO AL POR MAYOR A CAMBIO DE UNA RETRIBUCION O POR CONTRATA',
            'codigo' => '4610'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'REENCAUCHE DE LLANTAS USADAS',
            'codigo' => '2212'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE ADMINISTRACIÓN DE FONDOS',
            'codigo' => '6630'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACION DE OTROS PRODUCTOS QUIMICOS N.C.P.',
            'codigo' => '2029'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE OTRAS ASOCIACIONES N.C.P',
            'codigo' => '9499'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'PRESTACIÓN DE SERVICIOS JURÍDICOS, ASESORÍAS, CONSULTORAS Y EN GENERAL TODO TIPO DE ACTIVIDADES RELACIONADAS CON EL EJERCICIO PROFESIONAL DE ABOGACÍA',
            'codigo' => 'CD03'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'PROCESAMIENTO Y CONSERVACIÓN DE CARNE Y PRODUCTOS CÁRNICOS',
            'codigo' => '1011'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ELABORACIÓN DE PRODUCTOS LÁCTEOS',
            'codigo' => '1040'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'EDICIÓN DE PROGRAMAS DE INFORMÁTICA (SOFTWARE)',
            'codigo' => '5820'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ACTIVIDADES DE LAS AGENCIAS DE VIAJE',
            'codigo' => '7911'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'BANCOS COMERCIALES',
            'codigo' => '6412'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'TRILLA DE CAFÉ',
            'codigo' => '1061'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'PRESTACIÓN DE SERVICIOS',
            'codigo' => 'CD04'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE PULPAS (PASTAS) CELULÓSICAS; PAPEL Y CARTÓN',
            'codigo' => '1701'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'COMERCIO AL POR MAYOR DE EQUIPO, PARTES Y PIEZAS ELECTRÓNICOS Y DE TELECOMUNICACIONES',
            'codigo' => '4652'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'FABRICACIÓN DE HILOS Y CABLES ELÉCTRICOS Y DE FIBRA ÓPTICA',
            'codigo' => '2731'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'EDUCACIÓN BÁSICA PRIMARIA',
            'codigo' => '8513'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'AGENCIAMIENTO ADUANERO LAS DEMAS ACTIVIDADES INHERENTES AL MISMO Y ASESORÍA EN COMERCIO INTERNACIONAL',
            'codigo' => 'CD01'
        ]);

        DB::table('ciius')->insert([
            'nombre' => 'ASOCIACION GREMIAL SIN ANIMO DE LUCRO',
            'codigo' => 'CD02'
        ]);

    }
}
