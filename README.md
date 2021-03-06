# Laravel Xero

This package provides the standard xero payroll settings and sync from Xero.

## Installation

You can install the package via composer:

```bash
composer require dcodegroup/laravel-xero-payroll-au
```

Then run the install command.

```bash
php artsian laravel-xero-payroll-au:install
```

This will publish the configuration file and the migration file.

Run the migrations

```bash
php artsian migrate
```

## Configuration

Most of configuration has been set the fair defaults. However you can review the configuration file at `config/laravel-xero-payroll-au.php` and adjust as needed

If you want to have the oauth screens appear within your sites layout ensure to configure the environment variable. eg.

`LARAVEL_XERO_PAYROLL_AU_LAYOUT=layouts.admin`

<p align="center"><img src="/art/config.png" alt="Preview of the configuration screen"></p>

## Usage

The package provides an endpoints which you can use. See the full list by running
```bash
php artsian route:list --name=xero_payroll
```

They are

[example.com/xero-payroll] Which is where you will view and update the details from xero from.
