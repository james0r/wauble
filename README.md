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

### Cleanup themes directory, install themes dependencies, and run wp-cli commands to optimize WordPress for Wauble theme.

```bash
lando setup:theme
```

### Rebuild Local Environment

```bash
lando rebuild -y
```