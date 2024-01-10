<?php
$redis = new Redis();
$conn = $redis->connect('127.0.0.1', 6379);

if ($conn) {
    echo "Conexion exitosa: estas conectado a Redis... <br>";
    $command = true;
}
else {
    echo "No se pudo conectar con la base de datos de Redis :(";
}

if ($command) {
    //1: Crear y leer un registro

        //Asignamos los parametros: clave - valor
        $redis->set("llave", "Hola mundo");
        echo "llave=" . $redis->get("llave");

    //2: Crear y leer listas
        //Creamos un arreglo
        $redis->lpush("lista-bd", "Redis");
        $redis->lpush("lista-bd", "Oracle");
        $redis->lpush("lista-bd", "PostgreSQL");
        $redis->lpush("lista-bd", "Mysql");
        $redis->lpush("lista-bd", "Mongo");
        //Asignamos el arreglo a una variable
        $listbd = $redis->lrange("lista-bd", 0, 3); //extrear registros desde 0 a 3
        //Ciclo que muestra cada valor del arreglo
        foreach ($listbd as $nombre) {
            echo "<br>" . $nombre;
        }

    //3: Incrementar y decrementar el valor de una key
        //Inicializa la variable en 100
        $redis->set("counter", "100");
        //Le suma 1 osea 100+1=101
        $redis->incr("counter");
        //Le suma 9 osea 101+9=110
        $redis->incrBy("counter", 9);
        //Le resta 4 osea 110-4=106
        $redis->decrBy("counter", 4);
        //Le resta 1 osea 106-1=105
        $redis->decr("counter");
        //Muestra el resultado
        echo $redis->get("counter");

    //4: Crear y leer Hash
        echo "*** Hashes <br/>";
        //Al hash empleado:soporte le asiganmos un arreglo de datos
        $redis->hset("empleado:soporte", "nombre", "Eugenio");
        $redis->hset("empleado:soporte", "apellidos", "Chaparro Maya");
        $redis->hset("empleado:soporte", "email", "eucm2g@gmail.com");
        $redis->hset("empleado:soporte", "edad", "32");
        //Sacamos el array de llaves que contiene el hash empleado:soporte
        $keys = $redis->hkeys("empleado:soporte");
        //Hacemos un ciclo de todas la llaves del hash empleado:soporte
        foreach ($keys as $key) {
            //Obtenemos el valor de cada llave contenida en el hash
            $valor=$redis->hget("empleado:soporte", $key);
            //Mostramos la llave y su valor
        echo $key . ": " . $valor . "<br/>";
        }
}