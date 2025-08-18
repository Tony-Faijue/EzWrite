# EzWrite

A full stack blog application created with the Laravel framework. This is a web app where users can create blogs with images post them and view blogs from other users. Users are able to query for blogs by topics, title and authors.

## Purpose

The goal of this project is to create a platform for users to practice and develop their writing skills writing in a blog style format that is either formal or informal. Users can view the works of others gaining insight. By offering a no-pressure atmosphere, this project allows users to dedicate themselve to creating and viewing blogs.

## What I Learned

This project exposed me to various things that I knew of but did not fully have a grasp on such as Authentication, Routing, handling HTTP Responses & Requests, Testing, working with ORMs, Web Design concepts and Documentation. I believe this project helped me to better understand the fundamental principles that goes into planing, designing, creating, testing and recieving feedback for the project.

## Tech Stack

**Client:** Laravel, PHP, HTML/CSS, JavaScript, TailwindCSS

**Server:** Laravel, SQLite (Switch to PostgresSQL)

## Builds and Testing Tools

Testing Using PHPUnit

To run tests, run the following artisan command

```bash
  php artisan test
```

## Configurations

-   PHP = 8.2.12
-   Composer = 2.8.10
-   Node.JS = 24.6.0
-   SQLite (dev)
-   Git

## Installations and Running Locally

Install composer
https://getcomposer.org/download/

Install XAMMP
https://www.apachefriends.org/

Install NodeJS
https://nodejs.org/en

### 2. Follow Docs to Install Composer, NodeJS and XAMMP

```bash
  composer install
  npm install
```

## Quickstart

### 1. Clone the repository

```bash
  git clone https://github.com/Tony-Faijue/EzWrite.git
```

### 2. Configure Environment

```bash
  cp .env.example .env
```

### 3. Migrate and Seed the Database

```bash
  php artisan migrate --seed
```

### 4. Run the project

```bash
  composer run dev
```

or

```bash
  php artisan serve
```

## Report any Issues

There is bound to be issues with the Project.
If you find something wrong, Open a GitHub Issue:

👉 [Report a bug on GitHub](https://github.com/Tony-Faijue/EzWrite/issues)
