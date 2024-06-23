<?php

session_start();
require_once("C:/xampp/htdocs/Proj3k/connection/connect.php");

if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phonenumber = $_POST['phonenumber'];
    $line_id = $_POST['line_id'];
    $frontlength = $_POST['frontlength'];
    $shoulder = $_POST['shoulder'];
    $front_shoulder = $_POST['front_shoulder'];
    $back_shoulder = $_POST['back_shoulder'];
    $neck = $_POST['neck'];
    $chest = $_POST['chest'];
    $apart_chest = $_POST['apart_chest'];
    $height_chest = $_POST['height_chest'];
    $waist = $_POST['waist'];
    $hip = $_POST['hip'];
    $long_skirt = $_POST['long_skirt'];
    $long_sleeve = $_POST['long_sleeve'];
    $wide_arms = $_POST['wide_arms'];
    $long_shirt = $_POST['long_shirt'];
    $long_body = $_POST['long_body'];
    



    $sql = $conn->prepare("INSERT INTO customer(firstname, lastname, phonenumber, line_id, frontlength, shoulder,  front_shoulder, back_shoulder, neck, chest, apart_chest, height_chest, waist, hip, long_skirt, long_sleeve, wide_arms, long_shirt, long_body) VALUE(:firstname, :lastname, :phonenumber, :line_id, :frontlength, :shoulder,  :front_shoulder, :back_shoulder, :neck, :chest, :apart_chest, :height_chest, :waist, :hip, :long_skirt, :long_sleeve, :wide_arms, :long_shirt, :long_body)");
    $sql->bindParam(":firstname",$firstname);
    $sql->bindParam(":lastname",$lastname);
    $sql->bindParam(":phonenumber",$phonenumber);
    $sql->bindParam(":line_id",$line_id);
    $sql->bindParam(":frontlength",$frontlength);
    $sql->bindParam(":shoulder",$shoulder);
    $sql->bindParam(":front_shoulder",$front_shoulder);
    $sql->bindParam(":back_shoulder",$back_shoulder);
    $sql->bindParam(":neck",$neck);
    $sql->bindParam(":chest",$chest);
    $sql->bindParam(":apart_chest",$apart_chest);
    $sql->bindParam(":height_chest",$height_chest);
    $sql->bindParam(":waist",$waist);
    $sql->bindParam(":hip",$hip);
    $sql->bindParam(":long_skirt",$long_skirt);
    $sql->bindParam(":long_sleeve",$long_sleeve);
    $sql->bindParam(":wide_arms",$wide_arms);
    $sql->bindParam(":long_shirt",$long_shirt);
    $sql->bindParam(":long_body",$long_body);
    $sql->execute();

    if ($sql){
        $_SESSION['success'] = "Data has been inserted succesfully ";
        header("Location: customer_index.php");
    }else {
        $_SESSION['error'] = "Data has  not been inserted succesfully";
        header("Location: customer_index.php"); 
    }
}
