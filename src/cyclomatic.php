<?php
	// Abrimos fichero 
	$file_path = $argv[1];	
	$file_output = $argv[2];
	$delimiters = ",";
	$file_desc = fopen($file_path, "r");
	// Inicializamos variables del vector
	$ax = array();
	$ay = array();
	$bx = array();
	$by = array();

	$names_exists = array();

	
	$line_size = 300;
	
	while (($datos = fgetcsv($file_desc, $line_size, $delimiters)) !== FALSE) {
		// En el caso de que no sea númerico el número de entrada seguimos 
		if (!is_numeric($datos[0])) continue;
		// Si ya hemos parseado ese dato salimos 
		if (in_array($datos[0], $names_exists)) break;

		array_push($names_exists, $datos[0]);

		// Damos formato a todos nuestros datos 
		$datos[1] = str_replace("", 0, str_replace("FALSE", 0, trim($datos[1])));
		$datos[2] = str_replace("", 0, str_replace("FALSE", 0, trim($datos[2])));
		$datos[3] = str_replace("", 0, str_replace("FALSE", 0, trim($datos[3])));
		$datos[4] = str_replace("", 0, str_replace("FALSE", 0, trim($datos[4])));

		$datos[1] = str_replace("1", 1, str_replace("TRUE", 1, trim($datos[1])));
		$datos[2] = str_replace("1", 1, str_replace("TRUE", 1, trim($datos[2])));
		$datos[3] = str_replace("1", 1, str_replace("TRUE", 1, trim($datos[3])));
		$datos[4] = str_replace("1", 1, str_replace("TRUE", 1, trim($datos[4])));

		$datos[0] = (int) $datos[0];

		// Vamos creando nuestro vector
		array_push($ax, $datos[0]*$datos[1]);
		array_push($ay, $datos[0]*$datos[2]);
		array_push($bx, $datos[0]*$datos[3]);
		array_push($by, $datos[0]*$datos[4]);
	}

	fclose($file_desc);

	// Eliminamos en el vector cualquier tipo de elemento inexistente
	$ax = array_intersect($ax, $names_exists);
	$ay = array_intersect($ay, $names_exists);
	$bx = array_intersect($bx, $names_exists);
	$by = array_intersect($by, $names_exists);
	
	// Creamos los pares que se pueden asociar de A y B
	$letra = "A";
	$a = array_map('combinar', $ax, $ay);
	$letra = "B";
	$b = array_map('combinar', $bx, $by);
	
	// Creamos el fichero de salida con el resultado
	printCSV(array_merge($a,$b));

	/**
	 * Combina dos enteros creando un par asignado 
	 * a su correspondiente letra (A/B) obtenida 
	 * mediante su variable global
	 * @param int $x Variable X del vector
	 * @param int $y Variable Y del vector
	 * @return array Array ordenado del par
	 */
	function combinar($x,$y){
		global $letra;
		$array_null = array(null);
		$array = array($x,$y);
		asort($array);
		$array = array_diff($array, $array_null);
		$array = array_pad($array, 2, 0);
		$array = array_pad($array, 3, $letra);
		return $array;
	}

	/**
	 * Imprimimos en un fichero de salida todos 
	 * los pares obtenidos como resultado
	 */
	function printCSV($a){
		global $file_desc;
		global $file_output;
		$file_desc = fopen($file_output, 'w+');
		$line = "X,Y,A/B"."\n";
		fwrite($file_desc, $line);
		sort($a);
		array_map('printLines', $a);
		fclose($file_desc);
	}

	/**
	 * Imprimimos en la salida estándar el par
	 * @param array $data Array de pares
	 */
	function printLines($data){
		global $file_desc, $delimiters;
		$line = $data[0].$delimiters.$data[1].$delimiters.$data[2]."\n";
		fwrite($file_desc, $line);
	}


?>
