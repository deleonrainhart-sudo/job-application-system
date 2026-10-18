<?php
// Handles all database operations (CRUD) for job applications using PDO
class Application
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // CREATE
    public function create($data)
    {
        $sql = "INSERT INTO job_applications
                (first_name, last_name, email, contact_number, position_applied,
                 main_language, years_experience, portfolio_link, status)
                VALUES (:first_name, :last_name, :email, :contact_number, :position_applied,
                        :main_language, :years_experience, :portfolio_link, :status)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // READ (all records)
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM job_applications ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // READ (one record)
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM job_applications WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // UPDATE
    public function update($id, $data)
    {
        $sql = "UPDATE job_applications SET
                    first_name = :first_name,
                    last_name = :last_name,
                    email = :email,
                    contact_number = :contact_number,
                    position_applied = :position_applied,
                    main_language = :main_language,
                    years_experience = :years_experience,
                    portfolio_link = :portfolio_link,
                    status = :status
                WHERE id = :id";
        $data[':id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // DELETE
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM job_applications WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
