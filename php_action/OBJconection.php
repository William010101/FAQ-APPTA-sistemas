<<<<<<< HEAD
<?php
class Conexao
{
    private $pdo;

    public function conectar()
    {
        try {
            $this->pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=masterkey");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPdo()
    {
        if ($this->pdo === null) {
            $this->conectar();
        }
        return $this->pdo;
    }
}



=======
<?php
class Conexao
{
    private $pdo;

    public function conectar()
    {
        try {
            $this->pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=masterkey");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPdo()
    {
        if ($this->pdo === null) {
            $this->conectar();
        }
        return $this->pdo;
    }
}



>>>>>>> 478127839adca7eb7893823a23e04b27c3bcfc5d
