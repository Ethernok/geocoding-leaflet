<?php
class db
{
    private $serv = "localhost";
    private $base = "pedidos";
    private $user = "root";
    private $pass = "";
    private $session = null;
    public $connect = null;

    public function __construct()
    {

        try {
            $this->connect = new PDO(
                'mysql:host=' . $this->serv . ';
                dbname=' . $this->base,
                $this->user,
                $this->pass
            );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->query("SET NAMES 'utf8'");
        } catch (Exception $ex) {
            echo "Error de conexion" . $ex->getMessage();
        }
    }

    public function close()
    {
        $this->connect = null;
        $this->session = null;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getListaClientes()
    {
        $query = $this->connect->query("SELECT * FROM clientes ORDER BY id;");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function getCliente($id)
    {
        $query = $this->connect->prepare("SELECT * FROM clientes WHERE id = ?;");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // ------------------Nuevo pedido-----------------------
    public function nuevoPedido($id_cliente,$pedido, $direccion){
        $query = $this->connect->prepare("INSERT INTO pedidos(id, id_cliente, producto, direccion) VALUES(\" \",?,?,?);");
        $query->execute([$id_cliente, $pedido, $direccion]);
        $result = $this->connect->query("SELECT * FROM pedidos ORDER BY id;");
        $prueba = "No funciona";
        if ($result){
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return $prueba;
        }
        
    }
    public function getListaPedidos()
    {
        $query = $this->connect->query("SELECT * FROM pedidos;");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function procesarLogin($user, $pass)
    {

        $sql = $this->connect->prepare('SELECT * FROM usuarios WHERE usuario = ? AND clave = ?;');
        $sql->execute([$user, $pass]);
        $result = $sql->fetch(PDO::FETCH_OBJ);
        $this->session = $result->nombre;
        if (!$result) {
            header('Location: login.php');
        } elseif ($sql->rowCount() >= 1) {
            $_SESSION['nombre'] = $this->session;
            header('Location: index.php');
        }
    }

    public function nuevoVuelo($id, $vuelo, $origen, $destino, $horario, $compania)
    {
        try {
            $query = $this->connect->prepare("SELECT id_vuelo FROM vuelos WHERE id_vuelo = ?");
            $query->execute([$id]);
            $vueloResultado = $query->fetchAll(PDO::FETCH_OBJ);
            if (array_count_values($vueloResultado) >= 1) {
                echo "<script language=JavaScript>alert('El ID introducido ya está en uso');</script>";
                header('Location: index.php');
            }
            $query = $this->connect->prepare("INSERT INTO vuelos(id_vuelo, vuelo, origen, destino, horario, compañia) VALUES(?,?,?,?,?,?);");
            $query->execute([$id, $vuelo, $origen, $destino, $horario, $compania]);

            header('Location: index.php');
        } catch (Exception $e) {
            header('Location: index.php');
            throw new Exception("Error, comprueba de nuevo los datos", 1);
        }
    }
}
