<?php
class TechnicianDB {
    

public static function getTechnicians() {
    // ???
    if(!isset($query)){
    try{
    $db = Database::getDB();
    $query = 'SELECT * FROM technicians';
            //ORDER BY techID';
    $statement =$db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();
    $statement->closeCursor();

   // $fullName = Technician::getFullName()
    $technicians = array();
    foreach($rows as $row){       
        $technician = new Technician($row['techID'],
                             $row['firstName'],
                            $row['lastName'],
                            $row['email'],
                            $row['phone'],
                            $row['password']);
        $technicians[] = $technician;

    }
    }catch(PDOException $e){
            $error_message = 'PDOException: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        }catch(Throwable $e){
            $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        } catch(Exception $e){
            $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        }catch(Error $e){
            $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        } 
    }
    return $technicians;
}

public static function deleteTechnician($technician_id) {
    // ???
    if(!isset($query)){
    try{
        $db = Database::getDB();
        $query = 'DELETE FROM technicians
                WHERE techID = :tech_ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':tech_ID',$technician_id);
        $statement->execute();
        $statement->closeCursor();
    }catch(PDOException $e){
        $error_message = 'PDOException: '.$e->getMessage(). $e->getCode();
                include('../errors/database_error.php');
                exit();
    }catch(Throwable $e){
        $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                include('../errors/database_error.php');
                exit();
    } catch(Exception $e){
        $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                include('../errors/database_error.php');
                exit();
    }catch(Error $e){
        $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                include('../errors/database_error.php');
                exit();
         } 
    }

}

public static function addTechnician($first_name, $last_name, $email, $phone, $password) {
    // ???
    if(!isset($query)){
        try{
            $db = Database::getDB();
            $query = 'INSERT INTO technicians
                        (firstName, lastName, email, phone, password)
                    VALUES
                        (:first_name, :last_name, :email, :phone, :password)';
            $statement = $db->prepare($query);
            $statement->bindValue(':first_name', $first_name);
            $statement->bindValue(':last_name', $last_name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':password', $password);
            $statement->execute();
            $statement->closeCursor();
        }catch(PDOException $e){
            $error_message = 'PDOException: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        }catch(Throwable $e){
            $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        } catch(Exception $e){
            $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
        }catch(Error $e){
            $error_message = 'Exception: '.$e->getMessage(). $e->getCode();
                    include('../errors/database_error.php');
                    exit();
             } 
        }
}
/*
function update_technician($technician_id, $first_name, $last_name, $email, $phone, $password) {
    // ???
    global $db;
    $query = 'UPDATE technicians
                SET firstName = :first_name,
                    lastName = :last_name,
                    email = :email,
                    phone = :phone,
                    password = :password
                WHERE techID = :technician_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':technician_id', $technician_id);
    $statement->execute();
    $statement->closeCursor();

}
*/
}
?>