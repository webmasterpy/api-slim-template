<?php

    class Connection {

        public function connect() {
            try {
                $pdo = new PDO('mysql:host='.HOST.';dbname='.DBNAME.'', ''.USER.'', ''.PASS.'');
                $pdo->exec('set names utf8');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
                return $pdo;
            } catch (PDOException $e) {
                echo 'No database conection: ' . $e->getMessage();
            }
        }

    }

