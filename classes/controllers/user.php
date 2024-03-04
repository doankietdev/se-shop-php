<?php
require_once dirname(__DIR__) . "/services/message.php";
require_once dirname(__DIR__) . "/services/validation.php";
class User
{
    public $id;
    public $roleId;
    public $lastName;
    public $firstName;
    public $imageUrl;
    public $phoneNumber;
    public $email;
    public $address;
    public $username;
    public $password;
    public $createdAt;
    public $updatedAt;
    public $active;

    public function __construct(
        $id = null,
        $roleId = null,
        $lastName = null,
        $firstName = null,
        $imageUrl = null,
        $phoneNumber = null,
        $email = null,
        $address = null,
        $username = null,
        $password = null,
        $createdAt = null,
        $updatedAt = null,
        $active = 1
    ) {
        $this->id = $id;
        $this->roleId = $roleId;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->imageUrl = $imageUrl;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->address = $address;
        $this->username = $username;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->active = $active;
    }

    public static function authenticate($conn, $email, $password)
    {
        try {
            $query = "SELECT * FROM user WHERE email=:email LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(":email", $email, PDO::PARAM_INPUT_OUTPUT);
            $stmt->setFetchMode(PDO::FETCH_INTO, new User());
            if (!$stmt->execute())
                throw new PDOException("Cannot execute query");
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user)
                if (password_verify($password, $user->password))
                    return Message::messageData(true, "Login successfully", $user);
            return Message::message(false, "Cannot login with given information");
        } catch (Exception $e) {
            return Message::message(false, $e->getMessage());
        }
    }

    public static function createUser($conn, $adminId, $userData)
    {
        /**
         * Write your code here
         * Validate admin and userData
         */
    }

    public static function updateUser($conn, $userId, $userData)
    {
        try {
            // define user data pattern
            $userPattern = ['roleId', 'lastName', 'firstName', 'imageUrl', 'phoneNumber', 'email', 'address', 'username', 'password', 'active'];
            // validate user data
            if (!Validation::validateData($userPattern, $userData)) {
                throw new InvalidArgumentException('Invalid user data');
            }

            // Build user query string
            $userKeys = array_keys($userData);
            $queryBuilder = "UPDATE user SET";
            // Create set values depends on user data
            $setQueryBuilder = implode(",", array_map(fn ($key) => $key . "=:" . $key, $userKeys));
            $conditionQueryBuilder = "WHERE id=:userId";
            $updateStmt = $queryBuilder . " " . $setQueryBuilder . " " . $conditionQueryBuilder;

            $stmt = $conn->prepare($updateStmt);
            foreach ($userKeys as $key) {
                $stmt->bindValue(":" . $key, $userData[$key], PDO::PARAM_INPUT_OUTPUT);
            }
            $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
            $status = $stmt->execute();
            if (!$status) {
                throw new PDOException("Can not execute query");
            }
            return Message::message(true, "Update user successfully");
        } catch (Exception $e) {
            return Message::message(false, $e->getMessage());
        }
    }

    public static function deleteUser($conn, $adminId, $userId)
    {
        /**
         * Write your code here
         * Validate admin and userData
         */
    }

    public static function getUsers($conn, $adminId)
    {
        /**
         * Write your code here
         */
    }

    public static function getUserById($conn, $userId)
    {
        /**
         * Write your code here
         */
    }

    public static function getUserByUsername($conn)
    {
        /**
         * Write your code here
         */
    }
}
