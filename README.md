# Jan's Boardgames 🎲

This is a static site generator for my boardgames hobby.

The `generate-html.php` script reads the [Board Game Geek XML API](https://boardgamegeek.com/wiki/page/BGG_XML_API2) to retrieve my profile data and generates an HTML file.

GitHub Actions are used to deploy the static site.

## Usage

1. Run `composer install`
2. Run `make`
3. Open `build/index.html` in your browser

(The deployment to GitHub pages is handled by the GitHub action in `.github/workflows/pages.yml`)