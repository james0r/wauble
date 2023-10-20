# Wauble

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

### Setup Theme 

The below command cleans up themes directory, installs theme dependencies, and runs wp-cli commands to optimize WordPress for Wauble theme.

```bash
lando setup:theme
```

### Rebuild Local Environment

```bash
lando rebuild -y
```

## Create Wauble App

```bash
#!/bin/bash

CYAN='\033[0;36m'
NC='\033[0m'

echo -n "Theme Name (a-cool-new-theme): "
read -r new_theme_name

[[ -z "$new_theme_name" ]] && { echo "A new theme name must be provided. Exiting..." ; exit 1; }

new_theme_name=$(echo "$new_theme_name" | tr '[:upper:]' '[:lower:]')
new_theme_name=$(echo $new_theme_name | tr " " "-")

REPLACE_THEME_NAME_FILES=(
  "./$new_theme_name/.lando.yml"
  "./$new_theme_name/.env.example"
  "./$new_theme_name/.gitignore"
  "./$new_theme_name/composer.json"
  "./$new_theme_name/wordpress/wp-content/themes/$new_theme_name/style.css"
)
SOURCE_THEME_NAME="wauble"
GITHUB_REPO="git@github.com:james0r/wauble.git"

str_replace_in_files() {
  search=$1
  search_capitalized="$(tr '[:lower:]' '[:upper:]' <<<"${search:0:1}")${search:1}"
  search_uppercased=$(echo $search | tr '[:lower:]' '[:upper:]')
  
  replace=$2
  replace_uppercased=$(echo $replace | tr '[:lower:]' '[:upper:]')
  replace_capitalized="$(tr '[:lower:]' '[:upper:]' <<<"${replace:0:1}")${replace:1}"

  files=$3

  for file in "${files[@]}"; do
    sed -i "" "s/$search/$replace/" $file
    sed -i "" "s/$search_capitalized/$replace_capitalized/" $file
    sed -i "" "s/$search_uppercased/$replace_uppercased/" $file
  done

  echo "Theme name replaced ✅"
}

clone_repo() {
  repo=$1
  dir=$2

  git clone $repo $dir

  echo "Repo cloned ✅"
}

clone_repo $GITHUB_REPO $new_theme_name

mv $new_theme_name/wordpress/wp-content/themes/$SOURCE_THEME_NAME $new_theme_name/wordpress/wp-content/themes/$new_theme_name

str_replace_in_files $SOURCE_THEME_NAME $new_theme_name "${REPLACE_THEME_NAME_FILES[*]}"

echo "Install with the following commands:"
echo -e " \t * ${CYAN}cd $new_theme_name${NC}"
echo -e " \t * ${CYAN}lando start${NC}"
echo -e " \t * ${CYAN}lando setup:wordpress${NC}"
echo -e " \t * ${CYAN}lando setup:theme${NC}"
echo -e " \t * ${CYAN}lando rebuild -y${NC}"
echo "App created. Get to work bitch! 😎🤙"
```