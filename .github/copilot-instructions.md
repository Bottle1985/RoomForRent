# Copilot Instructions for RoomForRent

## Overview
This is a procedural PHP web application for apartment rental management. Pages are organized as single-entry PHP files that include shared header and database connection logic.

## Architecture
- `includes/header.php` contains the main HTML `<head>`, navigation, and `session_start()`.
- `connection.php` creates the single MySQL connection using hard-coded credentials.
- Each page usually does:
  - `include_once "includes/header.php"`
  - `include_once "connection.php"`
- Authentication relies on `$_SESSION['id1370950_demo_cse311']` and `$_SESSION['username']`.
- Data model is split across `members`, `available_flats`, `flat_details`, and `reserved_flats`.

## Important page responsibilities
- `login.php`: handles user login and sets the session.
- `register_page.php` / `save_member.php`: register new members.
- `post_ad.php` / `post_ad_save.php`: post a new flat and upload images into `apartment_images/`.
- `available_flats.php`: list flats with a SQL JOIN over `available_flats`, `members`, and `flat_details`.
- `flat_details.php`: show details for a flat using `$_GET['id']`.
- `reserve_flat.php`: insert a reservation record for the logged-in user.
- `post_edit.php` / `posteditdone.php`: edit existing flats.

## Project-specific conventions
- Use `include_once` for shared header and DB connection.
- The project uses procedural PHP mixed with HTML in the same file.
- Session gating is typically enforced by checking `if(!$_SESSION['id1370950_demo_cse311']) { header('location:login.php'); }`.
- SQL queries are built by string interpolation; avoid introducing new query patterns unless matching the current style.
- Image uploads are written to `apartment_images/` and referenced from `flat_details.php`.

## Workflow and environment
- No build or test scripts were found; this is a plain PHP/MySQL app.
- The README suggests deployment via a shared PHP host (e.g. InfinityFree).
- Local development should use a PHP server and MySQL database matching the schema in `DataBase/DB.sql`.

## Things to watch
- The repo has no separate config file; `connection.php` contains DB credentials.
- Pages may assume `session_start()` from `includes/header.php`; do not remove that dependency.
- `$_POST` and `$_GET` values are used directly in SQL and HTML, so preserve existing data flow when editing.
- `posteditdone.php` contains a typo in the SQL field name `availabile`.

## When editing
- Prefer minimal changes that preserve the current page-based flow.
- Keep the nav logic in `includes/header.php` and the login gate logic close to the top of pages.
- Use existing files as templates for new pages: `available_flats.php`, `flat_details.php`, `post_ad_save.php`.
