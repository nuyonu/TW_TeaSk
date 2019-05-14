<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created or updated successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
echo "<br>\n";


$sql_set_database = "USE myDB";
if ($conn->query($sql_set_database) === TRUE) {
    echo "Set database  successfully";
} else {
    echo "Error setting database: " . $conn->error;
}
echo "<br>\n";

$sql_Events = "DROP TABLE going_to_trainings, going_to_events, contacting";

if ($conn->query($sql_Events) == TRUE)
    echo "Table going_to_trainings, going_to_events, contacting deleted";
else
    echo "Error to delete table: " . $conn->error;

echo "<br>\n";

$sql_Events = "CREATE OR REPLACE TABLE  events( 
                    id          INTEGER NOT NULL AUTO_INCREMENT,
                    title       VARCHAR(100),
                    type        VARCHAR(100),
                    location    VARCHAR(100),
                    description VARCHAR(100),
                    price       INTEGER,
                    organizedBy VARCHAR(100),
                    beginDate   DATE ,
                    endDate     DATE ,
                    isValid     BOOLEAN,
                    difficulty  INTEGER,
                    PRIMARY KEY(id) 
)";
if ($conn->query($sql_Events) === TRUE) {
    echo "Table events created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
echo "<br>\n";


$sql_User = "CREATE OR REPLACE TABLE users(
                    id              INTEGER NOT NULL AUTO_INCREMENT,
                    username        VARCHAR(100),
                    e_mail          VARCHAR(100),
                    password        VARCHAR(100),
                    first_name      VARCHAR(100),
                    last_name       VARCHAR(100),
                    github_token    VARCHAR(100),
                    linkedin_token  VARCHAR(100),
                    PRIMARY KEY (ID) 
)";


if ($conn->query($sql_User) === TRUE) {
    echo "Table user created successfully";
} else {
    echo "Error creating table : " . $conn->error;
}
echo "<br>\n";


$sql_Trainings = "CREATE OR REPLACE TABLE trainings(
                    id              INTEGER NOT NULL AUTO_INCREMENT,
                    title           VARCHAR(100),
                    location        VARCHAR(100),
                    datetime        DATETIME,
                    domain          VARCHAR(100),
                    specifications  VARCHAR(100), 
                    stars           INTEGER,
                    difficulty      INTEGER,
                    price           INTEGER,
                    image           VARCHAR(100),
                    description     VARCHAR(1000),
                    PRIMARY KEY(id) 
                    
)";
if ($conn->query($sql_Trainings) === TRUE) {
    echo "Table trainings created successfully";
} else {
    echo "Error creating table : " . $conn->error;
}
echo "<br>\n";

$sql_contact_messages = "CREATE OR REPLACE TABLE contact_messages(
                      id            INTEGER NOT NULL AUTO_INCREMENT,
                      name          VARCHAR(40),
                      title         VARCHAR(50),
                      description   VARCHAR(200),
                      PRIMARY KEY(id)
)";
if ($conn->query($sql_contact_messages) === TRUE) {
    echo "Table sql_contact_messages created successfully";
} else {
    echo "Error creating table : " . $conn->error;
}
echo "<br>\n";


$sql_contacting = "CREATE OR REPLACE TABLE contacting(
                    id                  INTEGER NOT NULL AUTO_INCREMENT,
                    id_user             INTEGER,
                    id_contact_message  INTEGER,
                    PRIMARY KEY(id) ,
                    CONSTRAINT fk_id_user_contacting FOREIGN KEY(id_user) REFERENCES  users(id),
                    CONSTRAINT fk_id_contact_message_contacting FOREIGN KEY(id_contact_message) REFERENCES  contact_messages(id)
)";
if ($conn->query($sql_contacting) === TRUE) {
    echo "Table sql_contacting created successfully";
} else {
    echo "Error creating table : " . $conn->error;
}
echo "<br>\n";

$sql_Going_To_Trainings = "CREATE OR REPLACE TABLE going_to_trainings(
                            id          INTEGER NOT NULL AUTO_INCREMENT,
                            id_user     INTEGER,
                            id_training INTEGER,
                            PRIMARY KEY(id),
                            CONSTRAINT fk_id_user_going_to_trainings FOREIGN KEY(id_user) REFERENCES users(id),
                            CONSTRAINT fk_id_training_going_to_trainings FOREIGN KEY(id_training) REFERENCES trainings(id)
)";
if ($conn->query($sql_Going_To_Trainings) === TRUE) {
    echo "Table sql_Going_To_Trainings created successfully";
} else {
    echo "Error creating table : " . $conn->error;
}
echo "<br>\n";

$sql_Going_To_Events = "CREATE OR REPLACE TABLE going_to_events(
                    id          INTEGER NOT NULL AUTO_INCREMENT,
                    id_user     INTEGER ,
                    id_events   INTEGER ,
                    PRIMARY KEY (id) ,
                    CONSTRAINT fk_id_user_going_to_events FOREIGN KEY (id_events)  REFERENCES events(id),
                    CONSTRAINT fk_id_events_going_to_events FOREIGN KEY (id_user)    REFERENCES  users(id)
)";
if ($conn->query($sql_Going_To_Events) === TRUE) {
    echo "Table going_to_events created successfully";
} else {
    echo "Error creating table : " . $conn->error;
}
echo "<br>\n";

$sql_invo = "show ENGINE INNODB STATUS";

if ($conn->query($sql_invo) == TRUE) {
    echo "ok";
}
$conn->close();
?>