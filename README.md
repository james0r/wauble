# Lando Wordpress

## Getting Started

### Clone repo
```bash
git clone https://github.com/james0r/lando-wordpress.git
```

### Set up WordPress

In root directory run

```bash
lando start
lando setup:wordpress
```

### Install Wauble Starter Theme & Composer Managed Plugins

```bash
lando setup:environment
```

### Install Local Theme Deps

```bash
composer install
cd wordpress/wp-content/themes/wauble
npm install
npm run build
```