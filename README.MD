# Login and SignUp API for Language app using php

### SignUp: 
* endpoint: "http:/.../includes/signup.inc.php"<br/>
You can use it in a html form and it accepts following format or similar:

<form class = "forms" action = "includes/signup.inc.php" method="POST">
    <input type="text" name="firstname" placeholder = "Your firstname">
    <input type="text" name="lastname" placeholder = "Your lastname">
    <input type="text" name="username" placeholder = "Your Username">
    <input type="text" name="email" placeholder = "Your Email">
    <input type="password" name = "password" placeholder = "Your Password">
    <input type="password" name = "repassword" placeholder = "Retype your Password">
    
    <label for="language">language:</label>
    <select id="language" name="language">
    <option value="English">English</option>
    <option value="French">French</option>
    </select>
    <label for="level">Choose your level:</label>
    <select id="level" name="level">
    <option value="A1">A1</option>
    <option value="A2">A2</option>
    <option value="B1">B1</option>
    <option value="B2">B2</option>
    </select>
  * Outputs: name of the error or if the person is signed up their information in json format:
  ```
  {error : "emptyfields"
  }//for blank fields in forms
  {error : "invalidUsername"
  }//if username consists of charcters other than letters or numbers
  {error : "invalidEmail"
  }//invalid email
  {error : "nopasswordmatch"
  }//if the password and retyped password don't match
  {error : "usernameexists"
  }//if username already exists in database
  {error : "passwordshort"
  }//password character must be six or more
  ```
  if there is no error:
  ```
  {
  userid: ...,
  firstname: ...,
  lastname: ...,
  username: ...,
  useremail: ...,
  userpassword: ...//password is hashed,
  lang: ...,
  difficulty: ...
  }
  ```
  
  
  ### Login:
  *endpoint: "http:/.../includes/signup.inc.php"<br/>
  You can use it in a html form and it accepts following format or similar:
  ```
  <form class = "forms" action = "includes/login.inc.php" method="POST">
    <input type="text" name="username" placeholder = "Your Username/Email">
    <input type="password" name = "password" placeholder = "Your Password">
    <button type = "submit" name = "submit">Log in!</button>
</form>
  ```
  Interesting note: User can sign in with both their email **or** username
  * Outputs: name of the error or if the person is signed up their information in json format:
   ```
  {error : "emptyfields"
  }//for blank fields in forms
  {error : "wrongusername"
  }//wrong username
  {error : "wrongpassword"
  }//wrong password
  ```
  if there is no error:
  ```
  {
  userid: ...,
  firstname: ...,
  lastname: ...,
  username: ...,
  useremail: ...,
  userpassword: ...//password is hashed,
  lang: ...,
  difficulty: ...
  }
  ```
