# Simple PHP Firebase panel

Example admin panel for updating a cinema app's Firebase Realtime Database. The screen is branded Cineworld23 and Saray. Auth0 is meant to guard the page. Writes go through Kreait's PHP Firebase SDK.

Published March 2019, last touched January 2020.

Setup, as originally described:

1. Create an Auth0 application and put that quickstart (including `.env`) under the login folder. The code expects `adminlogin/`, not `adminpanel/`.
2. In `sender/`, run `composer install` for `kreait/firebase-php` ^4.18.
3. Fill `google-firebase.json` (the readme used to say `google-services.json`) with your own service account. `db.json` is only a sample of the `cwsaloon`, `cwsoon`, `srsaloon`, and `srsoon` shape.

Do not deploy this tree as-is.

## Notes from 18 October 2026

Reviewed again on this date. These points describe the code as it stands; they are not part of the original readme.

- Historical example. It is not being rewritten for current PHP, Auth0, or Kreait.
- No private key, client secret, or `.env` is in the tree or the git history. `google-firebase.json` is an empty service-account template: `project_id`, `private_key_id`, `client_email`, and `client_id` are blank, and there is no `private_key` field. Auth0 values are read with `getenv`.
- The repo cannot run from a clone. `adminlogin/login.php`, `logout.php`, `dotenv-loader.php`, and both `vendor/` directories are absent. `sendMovie.php` calls `withDatabaseUri()` with the URL commented out, so that file is not valid PHP.
- The write gate in `sendMovie.php` is `base64_decode($myTurn) == ''`. An empty name enters the Firebase block. A real signed-in name does not. The comment next to it says to put the allowed username there; it was left as an empty string.
- `db.json` is sample cinema listings (titles, genres, showtimes, trailer ids). It is not a credential file.
- Bootstrap 4.1.3 and jQuery 1.12.4 are committed in the repo. Dependabot has two open medium XSS alerts on that jQuery. A session value from `sentDivID` is also written into a `<script>` tag in `index.php` without escaping.
- There are no GitHub issues on this repository.
