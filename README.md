# SQL Injection – Educational Project

⚠️ **For educational purposes only**

This project demonstrates how SQL Injection vulnerabilities can compromise the
three fundamental principles of the **CIA Triad**:
**Confidentiality, Integrity and Availability**.

The application is intentionally vulnerable and must never be deployed in
production environments.

## Project Overview
The project simulates a login page of a web application affected by SQL Injection
vulnerabilities due to unsafe server-side SQL query handling.

The goal is to show, in a controlled environment, how an attacker can:
- Bypass authentication
- Access sensitive data
- Manipulate or delete database content

## Architecture
The application runs inside a containerized environment and is composed of:

- PHP backend exposed via Apache
- MySQL database for user and transaction storage
- Docker Compose for environment orchestration

## Code Structure (High-Level)
The repository contains the following main components:

- `index.php` – login endpoint and main attack entry point
- `ruoli.php` – displays the role associated with the authenticated user
- `utenti.php` – exposes user-related data
- `transazioni.php` – displays transactions associated with users
- `docker-compose.yml` – defines and starts the Dockerized environment

## Attack Simulation
The project demonstrates multiple SQL Injection attack scenarios, including:

- Authentication bypass via tautology
- Unauthorized access using SQL comments
- Destructive attacks using piggyback queries

Each attack is mapped to a specific violation of the CIA Triad.

## Documentation
Detailed technical documentation, including:
- Code analysis
- SQL payloads
- Database schema
- Step-by-step attack simulations

is available in the following document:

📄 **[SQL_INJECTION.pdf](./SQL_INJECTION.pdf)**

## Disclaimer
This project is intended strictly for educational and security research purposes.
