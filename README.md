# Drupal Decoupled Integrations: Drupal GraphQL demo site

## Get Started

### Clone site

```bash
git clone git@github.com:octahedroid/drupal-graphql-example.git
```

### Start ddev

```bash
ddev start
```

### Import Database dump from demo example

```bash
ddev import-db --file=db.sql.gz
```

### Login using drush

```bash
ddev drush uli admin
```

### Configure Simple OAuth Settings

Generate keys visiting `admin/config/people/simple_oauth` we suggest you to use `../` on the directory field at the overlay window.

Created two new Consumer client and assign the proper Scope of `Viewer` & `Previewer` to each one.

> Make sure you remember the values used as secret on each one because you will need them for the front-end env variables configuration.

More info about it at this blog post [Implementing Content Previews with Drupal and Remix](https://octahedroid.com/blog/implementing-content-previews-drupal-and-remix)
