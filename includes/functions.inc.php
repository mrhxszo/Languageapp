<?php

function emptyfield($firstname,$lastname,$username,$email,$password,$repassword){
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($repassword)){
        return true;
    }
    else return false;
}

function invalidusername($username){
    if(!(preg_match("/^[a-zA-z0-9]*$/", $username))){
        return true;
    }
    else{
        return false;
    }
}

function invalidemail($email){
    if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
        return true;
    }
    else{
        return false;
    }
}

function passwordmatch($password, $repassword){
    if($password !== $repassword){
        return true;
    }
    else{
        return false;
    }
}

function usernameexists($conn, $username, $email){
    $sql = "SELECT * FROM Users WHERE username = ? OR useremail = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$username,$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        return false;
    }

    mysqli_stmt_close($stmt);
}

function createuser($conn, $firstname, $lastname, $username, $email, $password, $language, $level){
    $sql = "INSERT INTO users(firstname,lastname,username,useremail,userpassword, lang, difficulty) VALUES(?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!(mysqli_stmt_prepare($stmt, $sql))){
        $error = ["error"=> "stmtfailed"];
        echo json_encode($error);
        exit();
    }

    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);


    mysqli_stmt_bind_param($stmt,"sssssss",$firstname, $lastname, $username, $email, $hashedpassword,$language,$level);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo json_encode(usernameexists($conn, $username, $password));
}


//loginfunctions

function emptyfieldlogin($username,$password){
    if ((empty($username) || empty($password))){
        return true;
    }
    else return false;
}

function loginUser($conn, $username, $password){
    $usernameexists = usernameexists($conn, $username, $username);

    if ($usernameexists === false) {
        $error = ["error"=> "wrongusername"];
        echo json_encode($error);
        exit();
    }

    $passwordhashed = $usernameexists["userpassword"];
    $checkpassword = password_verify($password, $passwordhashed);

    if($checkpassword === false){
        $error = ["error"=> "wrongpassword"];
        echo json_encode($error);
        exit();
    }

    elseif($checkpassword === true){
        session_start();
        $_SESSION["email"] = $usernameexists;
        $_SESSION["userid"] = $usernameexists["userid"];
        $_SESSION["username"] = $usernameexists["username"];
        echo json_encode(usernameexists($conn, $username, $password));
        exit();
    }

}
