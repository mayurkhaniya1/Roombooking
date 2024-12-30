<?php

    $host_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $dbname = 'roombooking';

    $con = mysqli_connect($host_name, $user_name, $password, $dbname);
    if (!$con) {
        die('Can not connect to database'. mysqli_connect_error());
    }

    function filtration($data) {
        return array_map(function($val) {
            return htmlspecialchars(strip_tags(stripslashes(trim($val))));
        }, $data);
    }
    
    
    function selectAll($con,$table){        
        $res = mysqli_query($con,"SELECT * FROM $table");
        return $res;
    }
    function select($con, $sql, $values, $datatypes) {
        try {
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Query preparation failed: -Select" . $con->error);
            }
    
            $stmt->bind_param($datatypes, ...$values);
            if (!$stmt->execute()) {
                throw new Exception("Query execution failed: -Select" . $stmt->error);
            }
    
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log($e->getMessage());
            throw $e; // Re-throw the exception
        }
    }
    
    function update($con, $sql, $values, $datatypes) {
        try {
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Query preparation failed: -update" . $con->error);
            }
    
            $stmt->bind_param($datatypes, ...$values);
            if (!$stmt->execute()) {
                throw new Exception("Query execution failed: -update" . $stmt->error);
            }
    
            $result = $stmt->affected_rows;
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log($e->getMessage());
            throw $e; // Re-throw the exception
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }
    
    function insert($con, $sql, $values, $datatypes) {
        try {
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Query preparation failed: -insert" . $con->error);
            }
    
            $stmt->bind_param($datatypes, ...$values);
            if (!$stmt->execute()) {
                throw new Exception("Query execution failed: -insert" . $stmt->error);
            }
    
            $result = $stmt->affected_rows;
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log($e->getMessage());
            throw $e; // Re-throw the exception
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    function delete($con, $sql, $values, $datatypes) {
        try {
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Query preparation failed: -Delete" . $con->error);
            }
    
            $stmt->bind_param($datatypes, ...$values);
            if (!$stmt->execute()) {
                throw new Exception("Query execution failed: -Delete" . $stmt->error);
            }
    
            $result = $stmt->affected_rows;
            return $result;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log($e->getMessage());
            throw $e; // Re-throw the exception
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }