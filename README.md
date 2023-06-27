# Lando Wordpress

## Getting Started

### Download
```bash
git clone git@github.com:james0r/wauble.git
```
or
```bash
create_wauble_app.sh
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

### Rebuild Local Environment

```bash
lando rebuild -y
```