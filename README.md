## :rocket: E-Surat

[![GitHub issues](https://img.shields.io/github/issues/hiskiia/e-surat)](https://github.com/hiskiia/e-surat/issues)
[![GitHub forks](https://img.shields.io/github/forks/hiskiia/e-surat)](https://github.com/hiskiia/e-surat/network)
[![GitHub stars](https://img.shields.io/github/stars/hiskiia/e-surat)](https://github.com/hiskiia/e-surat/stargazers)
[![GitHub license](https://img.shields.io/github/license/hiskiia/e-surat)](https://github.com/hiskiia/e-surat)

## WHAT IS E-SURAT?

E-Surat is Online Village Letter Submission Website.

## System Requirement

-   PHP Version 7.2 or Above
-   Composer
-   Git
-   NPM

## Installation

1. Open the terminal, navigate to your directory (htdocs or public_html).

```bash
git clone https://github.com/hiskiia/e-surat.git
cd e-surat
composer install
```

2. Run NPM

```
npm install && npm run dev
```


3. Setting the database configuration, open .env file at project root directory

```
DB_DATABASE=**your_db_name**
DB_USERNAME=**your_db_user**
DB_PASSWORD=**password**
```

4. Install Project

```bash
php artisan project:install
```

You will get the administrator credential and url access like example bellow:

```bash
::Administrator Credential::
URL Login: http://localhost/e-surat/public/admin/login
Email: admin
Password: 123456

```