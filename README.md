## Project Introduction

This project simulates the login page of a web application in order to demonstrate
how **SQL Injection vulnerabilities** can lead to violations of the three
fundamental principles of the **CIA Triad**:

- Confidentiality
- Integrity
- Availability

### Attack Scenarios

The goal of the project is to demonstrate how an attacker can:

- **Compromise Confidentiality** by bypassing authentication and accessing the
  web application without valid credentials.
- **Compromise Integrity** by manipulating accessible data and performing
  unauthorized modifications.
- **Compromise Availability** by deleting the users table from the database,
  rendering the system unusable.

At the end of the attack simulation, the server is no longer operational.

### Attack Environment

The web application is built using the following architecture:

- A **PHP backend** responsible for handling APIs and the web interface,
  exposed through **Apache**
- A **MySQL database** used to store users and transaction data

The entire environment is managed using **Docker Compose** to ensure ease of
execution across different machines.

Two separate containers are used:
- A web server container running PHP and Apache on port **80**
- A MySQL database container running on port **3306**

The application contains vulnerabilities caused by unsafe server-side SQL query
handling. These vulnerabilities can be exploited to perform **SQL Injection**
attacks.

The attack is carried out by forcing malicious interactions with the PHP login
endpoint and the user management APIs, allowing the attacker to bypass
authentication and gain access to sensitive data.


