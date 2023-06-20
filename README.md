
# SymfoContact

This project's goal is to create a simple contact form page containing only the form itself using the Symfony framework and Bootstrap.


## Requirements

- PHP 8.1 or higher
- Composer
- NPM
- Symfony CLI
- MySQL
## Installation

To run this project locally, first migrate the database using

```bash
  symfony console doctrine:migrations:migrate
```

Then run both the server and Webpack Encore using

```bash
  symfony server:start
```
and

```bash
  npm run watch
```

And let these last two run simultaneously.

After these steps, the page should be running under http://localhost:8000.

## Authors

[@csaba-j](https://www.github.com/csaba-j)

